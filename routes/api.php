<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LaundryProviderController;
use App\Http\Controllers\API\LaundryServiceController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReviewController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('laundry')->middleware(['role:laundry_providers'])->group(function () {
        Route::apiResource('/service', LaundryServiceController::class)->except(['index', 'show']);
        Route::apiResource('/provider', LaundryProviderController::class)->except(['index', 'show']);
    });


    Route::prefix('customer')->middleware(['role:customer'])->group(function () {
        Route::apiResource('/order', OrderController::class)->except(['index', 'show']);

        Route::apiResource('/review', ReviewController::class)->except(['index', 'show']);
    });


    Route::prefix('provider')->middleware(['role_or_permission:laundry_providers|edit-orders'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    });


    Route::get('/laundry-providers', [LaundryProviderController::class, 'index']);
    Route::get('/laundry-providers/{id}', [LaundryProviderController::class, 'show']);
    Route::get('/laundry-services', [LaundryServiceController::class, 'index']);
    Route::get('/laundry-services/{id}', [LaundryServiceController::class, 'show']);
});
