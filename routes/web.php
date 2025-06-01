<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LaundryProviderController;
use App\Http\Controllers\API\LaundryServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserController;
use App\Models\LaundryService;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::get('/laundry/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('laundry.dashboard.index');

// Route::get('/laundry/dashboard', function () {
//     return view('laundry.dashboard.index');
// })->middleware('auth')->name('laundry.dashboard.index');

Route::get('/customer/dashboard', [LaundryProviderController::class, 'searching'])->name('customer.dashboard.index');

Route::get('/provider', function () {
    return view('customer.cari.cari');
})->middleware('auth')->name('provider.index');

Route::get('/order-provider', function () {
    return view('customer.cari.order');
})->middleware('auth')->name('customer.order');

Route::get('/riwayat-customer', function () {
    return view('customer.riwayat.riwayat');
})->middleware('auth')->name('customer.riwayat.riwayat');

Route::get('/provider/list', [LaundryProviderController::class, 'index'])->name('provider.list');

Route::get('/services', [LaundryServiceController::class, 'index'])->name('services.index');
Route::resource('orders', OrderController::class);


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
