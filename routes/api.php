<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\JasaApiController;
use App\Http\Controllers\Api\UserControllerApi;
use App\Http\Controllers\Api\ProfileController;


// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::apiResource('products', ProductApiController::class)->only(['index', 'show']);
Route::apiResource('jasas', JasaApiController::class)->only(['index', 'show']);
Route::get('/user', [AuthController::class, 'user']); // Get authenticated user
Route::apiResource('users', UserControllerApi::class)->only(['index']);
Route::apiResource('categories', CategoryController::class);


// Protected routes     
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('products', ProductApiController::class)->except(['index', 'show']);
    Route::get('/user', [AuthController::class, 'user']); // Get authenticated user
    Route::apiResource('users', UserControllerApi::class)->except(['index']);
});



