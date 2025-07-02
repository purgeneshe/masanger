<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $otherUserId = $request->input('user_id');

        return Message::where(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $otherUserId);
        })
            ->orWhere(function ($query) use ($userId, $otherUserId) {
                $query->where('sender_id', $otherUserId)
                    ->where('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return response()->json($message->load('sender'), 201);
    }
}