<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Policies\TestUsersPolicy;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/users', function(){
        return 'users list';
    })->middleware('can:viewAny', User::class)
    ->name('users.show');
});