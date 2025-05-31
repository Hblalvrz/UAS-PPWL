<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LaundryProviderController;
use App\Http\Controllers\API\LaundryServiceController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\LaundryService;

Route::get('/', function () {
    return view('login.auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('laundry.dashboard.index');

Route::get('/order-provider', function () {
    return view('customer.dashboard.order');
})->middleware('auth')->name('customer.order');

Route::get('/provider/list', [LaundryProviderController::class, 'index'])->name('provider.list');

Route::get('/services', [LaundryServiceController::class, 'index'])->name('services.index');
Route::resource('orders', OrderController::class);


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
