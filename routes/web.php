<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;

// Public Routes
Route::get('/', function () {
    return view('user.index');
})->name('user.index');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/user', [AuthController::class, 'user'])->name('auth.user');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    // Admin Pages Routes
    Route::prefix('pages')->name('pages.')->group(function () {
        // Products
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/input-products', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.detail');

        // Categories
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
        Route::get('/input-categories', [CategoriesController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/input-users', [UserController::class, 'create'])->name('users.create');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');

        // Transactions
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    });
});
