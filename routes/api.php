<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers;

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);


    Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index']);
    Route::post('/messages', [App\Http\Controllers\MessageController::class, 'store']);