<?php

use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\OrderApiController;
use Illuminate\Support\Facades\Route;

Route::get('/customers', [CustomerApiController::class, 'index']);
Route::get('/customers/{customer}/orders', [CustomerApiController::class, 'orders']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderApiController::class, 'store']);
});