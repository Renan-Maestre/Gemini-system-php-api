<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GoogleController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

//Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rota para iniciar o login
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
// Rota que o Google chama de volta
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('product', ProductController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('clients', ClientController::class);

    Route::post('product/{uuid}/image', [ProductController::class, 'updateImage']);

    Route::get('/me', function (Request $request) {
        return new \App\Http\Resources\UserResource($request->user());
    });

});
