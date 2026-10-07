<?php


use App\Http\Controllers\Api\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Otomatis mencakup index, store, show, update, destroy
Route::apiResource('products', ProductController::class);
Route::get('/clear-cache', function () {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return response()->json(['message' => 'Cache server berhasil dibersihkan!']);
});