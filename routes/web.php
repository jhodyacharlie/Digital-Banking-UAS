<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\NotificationController;

Route::get('/', [LoginController::class, 'show'])->name('home');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/payment', [PayController::class, 'index']);
    Route::post('/payment', [PayController::class, 'store']);
    Route::get('/status', [StatusController::class, 'index']);
    Route::get('/notifications', [NotificationController::class, 'index']);
});
