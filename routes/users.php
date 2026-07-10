<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update');

Route::patch('/users/{user}/activate', [UserController::class, 'activate'])
    ->name('users.activate');

Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])
    ->name('users.deactivate');

Route::put('/users/{user}/reset-password', [UserController::class, 'resetPassword'])
    ->name('users.reset-password');
    