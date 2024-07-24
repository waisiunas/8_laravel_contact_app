<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\ProfileController;
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

Route::middleware(Authenticate::class)->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('user/dashboard', 'index')->name('user.dashboard');
    });

    Route::controller(ProfileController::class)->prefix('user/profile')->name('user.profile.')->group(function () {
        Route::get('show', 'show')->name('show');
        Route::patch('details', 'details')->name('details');
        Route::patch('password', 'password')->name('password');
        Route::patch('picture', 'picture')->name('picture');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('user/categories', 'index')->name('user.categories');
    });
});
