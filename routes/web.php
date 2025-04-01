<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::post('register', [RegisterController::class, 'store'])->name('register');

Route::middleware('valid.link')->group(function () {
    Route::get('/page-a/{uuid}', [GameController::class, 'show'])->name('game.show');
    Route::post('/page-a/{uuid}/roll', [GameController::class, 'roll'])->name('game.roll');
    Route::get('/page-a/{uuid}/history', [GameController::class, 'history'])->name('game.history');

    Route::post('/link/{uuid}/regenerate', [LinkController::class, 'regenerate'])->name('link.regenerate');
    Route::post('/link/{uuid}/deactivate', [LinkController::class, 'deactivate'])->name('link.deactivate');
});
