<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LaundryProviderController;
use App\Http\Controllers\API\LaundryServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use App\Models\LaundryService;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::get('/laundry/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('laundry.dashboard.index');

Route::get('/customer/dashboard', [LaundryProviderController::class, 'searching'])->name('customer.dashboard.index');

Route::get('/provider', function () {
     return view('customer.cari.cari');
})->middleware('auth')->name('provider.index');

Route::get('/customer/order/{provider}', [\App\Http\Controllers\OrderController::class, 'create'])->name('customer.order');
Route::post('/customer/order', [\App\Http\Controllers\OrderController::class, 'storecustomer'])->name('customer.order.store');

Route::get('/riwayat-customer', [OrderController::class, 'history'])->name('customer.riwayat.riwayat');
Route::get('/orders/{id}/detail', [OrderController::class, 'showDetail'])->name('orders.showDetail');
Route::get('/review/{orderId}', [\App\Http\Controllers\API\OrderController::class, 'review'])->name('customer.ulasan');
Route::post('/review', [ReviewController::class, 'store'])->name('customer.review.store');

Route::get('/provider/list', [LaundryProviderController::class, 'index'])->name('provider.list');

Route::middleware(['auth'])->group(function () {
     // Routes untuk Layanan
     Route::get('/services', [LaundryServiceController::class, 'index'])
          ->name('services.index');
     Route::get('/services/create', [LaundryServiceController::class, 'create'])
          ->name('services.create');
     Route::post('/services', [LaundryServiceController::class, 'store'])
          ->name('services.store');
     Route::get('/services/{id}/edit', [LaundryServiceController::class, 'edit'])
          ->name('services.edit');
     Route::put('/services/{id}', [LaundryServiceController::class, 'update'])
          ->name('services.update');
     Route::delete('/services/{id}', [LaundryServiceController::class, 'destroy'])
          ->name('services.destroy');

     // Routes untuk Order Management (Laundry Provider)
     Route::get('/orders', [ControllersOrderController::class, 'index'])
          ->name('orders.index');
     Route::get('/orders/create', [ControllersOrderController::class, 'create'])
          ->name('orders.create');
     Route::post('/orders', [ControllersOrderController::class, 'store'])
          ->name('orders.store');
     Route::get('/orders/{order_id}', [ControllersOrderController::class, 'show'])
          ->name('orders.show');
     Route::get('/orders/{order_id}/edit', [ControllersOrderController::class, 'edit'])
          ->name('orders.edit');
     Route::put('/orders/{order_id}', [ControllersOrderController::class, 'update'])
          ->name('orders.update');
     Route::delete('/orders/{order_id}', [ControllersOrderController::class, 'destroy'])
          ->name('orders.destroy');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
