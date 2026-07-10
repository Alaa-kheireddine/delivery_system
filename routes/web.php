<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','user.is_active', 'password.changed'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard.index')->middleware('auth');

    require __DIR__.'/branches.php';
    require __DIR__.'/users.php';
    require __DIR__.'/roles.php';
    require __DIR__.'/clients.php';

});

require __DIR__.'/auth.php';