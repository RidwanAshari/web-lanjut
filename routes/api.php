<?php


use App\Http\Controllers\Api\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Otomatis mencakup index, store, show, update, destroy
Route::apiResource('products', ProductController::class);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);