<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;

Route::resource('accounts', AccountController::class);
Route::resource('balances', BalanceController::class);

Route::get('/', function () {
    return redirect('/posts');
});

Route::resource('posts', PostController::class);