<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Admin\Api\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\JasaApiController;


// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::apiResource('products', ProductApiController::class)->only(['index', 'show']);
Route::apiResource('jasas', JasaApiController::class)->only(['index', 'show']);

// Protected routes     
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('products', ProductApiController::class)->except(['index', 'show']);
    Route::get('/user', [AuthController::class, 'user']); // Get authenticated user
});

// Category routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});