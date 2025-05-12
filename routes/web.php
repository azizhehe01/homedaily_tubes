<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoriesController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    // Pages Routes
    Route::prefix('pages')->name('pages.')->group(function () {
        // Products Pages
        Route::get('/input-products', [ProductController::class, 'create'])->name('input-products');
        Route::post('/input-products', [ProductController::class, 'store'])->name('store-products');
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Categories Pages
        Route::get('/input-categories', [CategoriesController::class, 'create'])->name('input-categories');
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');

        // Users Pages
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/input-users', [UserController::class, 'create'])->name('users');

        // Orders Pages
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');

        // Transactions Pages
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    });
});