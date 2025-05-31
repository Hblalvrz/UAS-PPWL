<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login.auth.login');
});

Route::get('/laundry/dashboard', function () {
    return view('laundry.dashboard.index');
})->middleware('auth')->name('laundry.dashboard.index');

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard.index');
})->middleware('auth')->name('customer.dashboard.index');

Route::get('/services', [LaundryServiceController::class, 'index'])->name('services.index');
Route::resource('orders', OrderController::class);


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
