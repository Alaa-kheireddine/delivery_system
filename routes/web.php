<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard.index')->middleware('auth');

require __DIR__.'/auth.php';
require __DIR__.'/branches.php';