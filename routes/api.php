<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Auth\AuthController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::apiResource('products', ProductApiController::class)->only(['index', 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('products', ProductApiController::class)->except(['index', 'show']);
    Route::get('/user', [AuthController::class, 'user']); // Get authenticated user
});
