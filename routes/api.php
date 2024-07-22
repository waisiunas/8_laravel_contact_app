<?php

use App\Http\Controllers\user\api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(CategoryController::class)->group(function () {
    Route::post('/user/category/create', 'store')->name('api.user.category.create');
});
