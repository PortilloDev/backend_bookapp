<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [LoginController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function (){
    // Books
        Route::apiResource('books', BookController::class);

    // Categories
        Route::apiResource('categories', CategoryController::class);

    // Tags
        Route::apiResource('tags', TagController::class);
});

