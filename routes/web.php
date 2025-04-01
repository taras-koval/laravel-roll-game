<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::post('register', [RegisterController::class, 'store'])->name('register');

Route::get('/page-a/{uuid}', [GameController::class, 'show'])->middleware('valid.link')->name('page.a');
