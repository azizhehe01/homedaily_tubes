<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;  
use App\Http\Controllers\ServiceController; 
use App\Http\Controllers\CategoryController;

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Service Routes
Route::resource('admin/service', ServiceController::class);
Route::resource('admin/categories', CategoryController::class);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');