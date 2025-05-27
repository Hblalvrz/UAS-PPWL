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
    Route::prefix('laundry-providers')->middleware(['role:laundry_providers'])->group(function () {
        Route::apiResource('/', LaundryProviderController::class)->except(['index', 'show']);
    });
    Route::prefix('laundry-services')->middleware(['role:laundry_providers'])->group(function () {
        Route::apiResource('/', LaundryServiceController::class)->except(['index', 'show']);
    });

    Route::prefix('orders')->middleware(['role:customer'])->group(function () {
        Route::apiResource('/', OrderController::class)->except(['index', 'show']);
    });

    Route::prefix('reviews')->middleware(['role:customer'])->group(function () {
        Route::apiResource('/', ReviewController::class)->except(['index', 'show']);
    });

    Route::middleware(['permission:edit-orders'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::put('/orders/{id}', [OrderController::class, 'update']);
    });
});