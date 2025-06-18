<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::resource('products', ProductController::class)->names('product');
Route::resource('categories', CategoryController::class)->names('category');

