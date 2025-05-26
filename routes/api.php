<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LaundryProviderController;
use App\Http\Controllers\API\LaundryServiceController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReviewController;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
});

Route::apiResource('laundry-providers', LaundryProviderController::class);
Route::apiResource('laundry-services', LaundryServiceController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('reviews', ReviewController::class);