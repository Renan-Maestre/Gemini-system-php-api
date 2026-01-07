<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

//Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('product', ProductController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('clients', ClientController::class);

    Route::post('product/{uuid}/image', [ProductController::class, 'updateImage']);

});
