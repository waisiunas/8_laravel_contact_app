<?php

use App\Http\Controllers\user\api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(CategoryController::class)->prefix('user')->name('api.user.')->group(function () {
    Route::get('{id}/categories', 'index')->name('categories');
    Route::prefix('category')->name('category.')->group(function () {
        Route::post('create', 'store')->name('create');
        Route::get('{id}/show', 'show')->name('show');
        Route::patch('{id}/update', 'update')->name('update');
        Route::delete('{id}/destroy', 'destroy')->name('destroy');
    });
});
