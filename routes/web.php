<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\DashboardController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->group(function () {
        Route::get('/', 'login_view')->name('login');
        Route::post('/', 'login');
        Route::get('register', 'register_view')->name('register');
        Route::post('register', 'register');
    });
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(DashboardController::class)->middleware(Authenticate::class)->group(function () {
    Route::get('user/dashboard', 'index')->name('user.dashboard');
});
