<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('chats', function () {
    return Inertia::render('Chats');
})->middleware(['auth', 'verified'])->name('chats');

Route::get('/chats/{user?}', [Controllers\UserController::class, 'showDetail'])
    ->name('chats.show')
    ->middleware(['auth', 'verified']);



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/api.php';
