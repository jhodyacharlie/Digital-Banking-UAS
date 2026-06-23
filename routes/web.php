<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;

Route::resource('accounts', AccountController::class)->except(['show']);
Route::resource('balances', BalanceController::class)->except(['show']);

Route::get('/', function () {
    return redirect('/accounts');
});

Route::resource('posts', PostController::class);
