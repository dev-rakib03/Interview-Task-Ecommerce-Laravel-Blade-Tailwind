<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use Illuminate\Support\Facades\Route;

Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('shop', [ShopController::class, 'shop'])->name('shop');
    Route::get('product/{slag}', [ShopController::class, 'product_show'])->name('product.show');
    Route::get('product-list', [ShopController::class, 'product_list'])->name('product.list');
});
