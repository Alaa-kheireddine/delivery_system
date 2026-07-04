<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Policies\TestUsersPolicy;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.store');
});

Route::middleware(['auth', 'activate.user'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/force-change-password', [AuthController::class, 'showForcePasswordChangeForm'])
        ->name('password.force-change');

    Route::put('/force-change-password', [AuthController::class, 'forcePasswordChange'])
        ->name('password.force-change.update');

    Route::get('/profile', [ProfileController::class, 'showProfile'])
        ->name('profile.show')
        ->middleware('password.changed');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->middleware('password.changed')
        ->name('profile.password.update');

});