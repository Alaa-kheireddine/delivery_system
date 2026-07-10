<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/clients', [ClientController::class, 'index'])
    ->name('clients.index');

Route::get('/clients/{client}', [ClientController::class, 'show'])
    ->name('clients.show');

Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])
    ->name('clients.edit');

Route::put('/clients/{client}', [ClientController::class, 'update'])
    ->name('clients.update');
