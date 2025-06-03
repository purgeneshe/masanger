<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Inertia\Inertia;
class UserController extends Controller
{
    public function index()
    {
        $currentUserId = Auth::id();

        return User::where('id', '!=', $currentUserId)->get();
    }

//    public function getUserById(int $id){
//        return User::where('id', '=', $_REQUEST['id'])->get();
//    }


    public function showDetail(Request $request)
    {
        $userId = $request->route('user');
        $user = $userId ? User::find($userId) : null;

        return Inertia::render('chat/ChatDetail', [
            'user' => $user
        ]);
    }
}
