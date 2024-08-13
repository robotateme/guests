<?php

use App\Http\Controllers\GuestsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/guests')->group(function () {
    Route::get('/list', [GuestsController::class, 'index']);
    Route::get('/show/{id}', [GuestsController::class, 'show']);
    Route::put('/store', [GuestsController::class, 'store']);
    Route::post('/update', [GuestsController::class, 'update']);
    Route::delete('/delete/{id}', [GuestsController::class, 'destroy']);
})->middleware('terminated');
