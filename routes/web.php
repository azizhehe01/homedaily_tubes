<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminJasa\ProductController as AdminJasaProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Auth\AuthController; 
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\MidtransNotificationController;


Route::get('/test-midtrans', [BookingController::class, 'testMidtransConfig']);
//Midtrans Notification Routes
Route::post('payments/midtrans-notification', [MidtransNotificationController::class, 'receive']);

// Booking Route
Route::middleware(['auth'])->group(function () {
    // Existing routes
    Route::get('/booking', [BookingController::class, 'showBookingForm'])->name('booking.form');
    Route::post('/booking/create', [BookingController::class, 'createBooking'])->name('booking.create'); // Add this new route
    Route::post('/booking/address', [BookingController::class, 'storeAddress'])->name('booking.address.store');
    Route::get('/booking/address/edit', [BookingController::class, 'editAddress'])->name('booking.address.edit');
    Route::put('/booking/address', [BookingController::class, 'updateAddress'])->name('booking.address.update');
    Route::post('/booking/process', [BookingController::class, 'processBooking'])->name('booking.process');
    Route::get('/orders', [BookingController::class, 'getOrders'])->name('user.orders');
    Route::post('/order/{orderId}/update-status', [BookingController::class, 'updateStatus'])
        ->name('order.update-status')
        ->withoutMiddleware(['csrf']);
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/pending', [OrderController::class, 'pending'])->name('order.pending');
    Route::get('/order/failed', [OrderController::class, 'failed'])->name('order.failed');
    Route::put('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.update-status');
});

Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');

//Public Routes
Route::get('/', [ProductController::class, 'frontendIndex'])->name('user.index');
Route::get('/products/{product_id}', [ProductController::class, 'showDetail'])->name('user.product.detail');


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

// di bawah ini untuk chat 
Route::middleware('auth')->group(function() {
    Route::post('/products/{product_id}/chat', [ProductController::class, 'sendChat'])
        ->name('product.chat');
        
    Route::get('/products/{product_id}/chats', [ProductController::class, 'getChats'])
        ->name('product.chats');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth:sanctum')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');


    // Pages Routes
    Route::prefix('pages')->name('pages.')->group(function () {
        // Products Pages
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('input-products');
        Route::post('/products', [ProductController::class, 'store'])->name('store-products');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.detail');

        // Categories Routes
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
        Route::get('/categories/create', [CategoriesController::class, 'create'])->name('input-categories');
        Route::post('/categories', [CategoriesController::class, 'store'])->name('store-categories');
        Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');


        // Users Pages

        // Users Routes (hanya edit dan hapus)
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


        // Orders Pages
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');


        // Transactions Pages
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    });
});

//Admi Jasa Routes
Route::prefix('admin_jasa')->name('admin_jasa.')->middleware('auth:sanctum')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin_jasa.dashboard.index');
    })->name('dashboard');

    Route::prefix('pages')->name('pages.')->group(function () {
        // Products Pages
        Route::get('/products', [AdminJasaProductController::class, 'index'])->name('products');
        Route::get('/products/create', [AdminJasaProductController::class, 'create'])->name('input-products');
        Route::post('/products', [AdminJasaProductController::class, 'store'])->name('store-products');
        Route::get('/products/{product}/edit', [AdminJasaProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [AdminJasaProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [AdminJasaProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/products/{product}', [AdminJasaProductController::class, 'show'])->name('products.detail');
    });
});

Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::put('/profile/photo', [UserProfileController::class, 'updatePhoto'])->name('user.profile.photo.update');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password.update');
    //ini  bagian dari alama yang di bawah  ini ya kocak
    Route::post('/profile/address', [UserProfileController::class, 'storeAddress'])->name('user.profile.address.store');
    Route::put('/profile/address/{address}', [UserProfileController::class, 'updateAddress'])->name('user.profile.address.update');
    Route::delete('/profile/address/{address_id}', [UserProfileController::class, 'destroyAddress'])->name('user.profile.address.destroy');
});


//route logout
Route::post('/logout', function (Request $request) {
    // Untuk web session (browser)
    Auth::guard('web')->logout();
    // Jika pakai API token (optional)
    if ($request->user()) {
        $request->user()->tokens()->delete(); // Hapus semua token API
    }
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
