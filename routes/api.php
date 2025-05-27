<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LaundryProviderController;
use App\Http\Controllers\API\LaundryServiceController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReviewController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Protected routes with authentication
Route::middleware('auth:sanctum')->group(function () {
    
    // Routes untuk Laundry Providers
    Route::prefix('laundry-providers')->middleware(['role:laundry_providers'])->group(function () {
        Route::post('/', [LaundryProviderController::class, 'store']);
        Route::put('/{id}', [LaundryProviderController::class, 'update']);
        Route::delete('/{id}', [LaundryProviderController::class, 'destroy']);
    });
    
    // Routes untuk Laundry Services
    Route::prefix('laundry-services')->middleware(['role:laundry_providers'])->group(function () {
        Route::post('/', [LaundryServiceController::class, 'store']);
        Route::put('/{id}', [LaundryServiceController::class, 'update']);
        Route::delete('/{id}', [LaundryServiceController::class, 'destroy']);
    });

    // Routes untuk Customer - Orders
    Route::prefix('customer')->middleware(['role:customer'])->group(function () {
        // Customer dapat membuat, mengupdate, dan menghapus order mereka sendiri
        Route::post('/orders', [OrderController::class, 'store']);
        Route::put('/orders/{id}', [OrderController::class, 'update']);
        Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
        
        // Customer dapat membuat, mengupdate, dan menghapus review mereka sendiri
        Route::post('/reviews', [ReviewController::class, 'store']);
        Route::put('/reviews/{id}', [ReviewController::class, 'update']);
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
    });

    // Routes untuk Provider - Management Orders (dengan permission khusus)
    Route::prefix('provider')->middleware(['role_or_permission:laundry_providers|edit-orders'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    });
    
    // Public view routes (bisa diakses semua user yang login)
    Route::get('/laundry-providers', [LaundryProviderController::class, 'index']);
    Route::get('/laundry-providers/{id}', [LaundryProviderController::class, 'show']);
    Route::get('/laundry-services', [LaundryServiceController::class, 'index']);
    Route::get('/laundry-services/{id}', [LaundryServiceController::class, 'show']);
});
