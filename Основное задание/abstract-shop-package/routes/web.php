<?php

use Illuminate\Support\Facades\Route;
use Bystrov\AbstractShop\Http\Controllers\CategoryController;
use Bystrov\AbstractShop\Http\Controllers\ProductController;
use Bystrov\AbstractShop\Http\Controllers\SupplierController;
use Bystrov\AbstractShop\Http\Controllers\CustomerController;
use Bystrov\AbstractShop\Http\Controllers\WarehouseController;
use Bystrov\AbstractShop\Http\Controllers\OrderController;

Route::get('/', fn () => redirect()->route('abstract-shop.products.index'))->name('abstract-shop.home');

Route::name('abstract-shop.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'create', 'store', 'destroy']);
});

