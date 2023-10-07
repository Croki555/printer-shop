<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Basket\BasketController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('catalog/{category?}{sort?}{page?}', [CatalogController::class, 'index'])->name('catalog');
Route::get('product/{id?}', [ProductController::class, 'index'])->name('product')->where('id', '[0-9]+');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('auntificate', [LoginController::class, 'auntificate'])->name('auntificate');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register-store', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('admin')->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('authUser')->group(function () {
    Route::post('basket/add/{product_id}', [BasketController::class, 'add'])->name('basket.add')->where('id', '[0-9]+');
    Route::post('basket/edit/{product_id}', [BasketController::class, 'edit'])->name('basket.edit')->where('id', '[0-9]+');

    Route::delete('basket/delete/{product_id}', [BasketController::class, 'delete'])->name('basket.delete')->where('id', '[0-9]+');

    Route::get('basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
    Route::post('basket/booking', [BasketController::class, 'booking'])->name('basket.booking');

    Route::get('basket', [BasketController::class, 'index'])->name('basket');

    Route::get('orders', [OrderController::class, 'index'])->name('orders');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
