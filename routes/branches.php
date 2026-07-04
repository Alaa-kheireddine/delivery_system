<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;


Route::middleware(['auth'])->group(function(){
    Route::get('/branches', [BranchController::class, 'index'])
    ->name('branches.index');

    Route::get('/branches/{branch}', [BranchController::class, 'show'])
        ->name('branches.show');

    Route::post('/branches', [BranchController::class, 'store'])
        ->name('branches.store');

    Route::put('/branches/{branch}', [BranchController::class, 'update'])
        ->name('branches.update');

    Route::patch('/branches/{branch}/activate', [BranchController::class, 'activate'])
        ->name('branches.activate');

    Route::patch('/branches/{branch}/deactivate', [BranchController::class, 'deactivate'])
        ->name('branches.deactivate');
});
    