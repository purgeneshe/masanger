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

    /**
     * @param int $id
     * @return null
     */
    public function getUserById(int $id){
        $user = $id ? User::find($id) : null;

        return $user;
    }


    /**
     * @param Request $request
     * @return \Inertia\Response
     *
     * user - Необязательная переменная с web.php
     */
    public function showDetail(Request $request)
    {

        $user = $this->getUserById($request->route('user'));


        return Inertia::render('chat/ChatDetail', [
            'user' => $user
        ]);
    }
}
