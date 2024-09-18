<?php

use App\Http\Controllers\Carts\v1\CartController;
use App\Http\Controllers\Products\v1\ProductController;
use App\Http\Controllers\Users\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/user/login', [AuthController::class, 'login']);

Route::prefix('/v1/')->middleware('auth:sanctum')->group(function () {

    // PRODUCT
    Route::prefix('/product')->group(function () {
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
    });

    // CART
    Route::prefix('/cart')->group(function () {
        Route::get('/{user}', [CartController::class, 'index'])->name('cart.index');
        Route::post('/', [CartController::class, 'store'])->name('cart.store');
    });
});
