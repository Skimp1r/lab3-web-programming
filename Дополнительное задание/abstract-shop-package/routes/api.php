<?php

use Illuminate\Support\Facades\Route;
use Bystrov\AbstractShop\Http\Controllers\Api\ProductController;
use Bystrov\AbstractShop\Http\Controllers\Api\CategoryController;

// Products use expected version from config (default 1)
Route::apiResource('products', ProductController::class)->middleware('api.version');

// Categories demonstrate per-route version override (expects 2)
Route::apiResource('categories', CategoryController::class)->middleware('api.version:2');

