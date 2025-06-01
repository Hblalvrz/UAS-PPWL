<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LaundryProviderController;
use App\Http\Controllers\API\LaundryServiceController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserController;
use App\Models\LaundryService;


Route::get('/', function () {

    return view('login.auth.login')->name('login');
});

Route::get('/laundry/dashboard', function () {
    return view('laundry.dashboard.index');
})->middleware('auth')->name('laundry.dashboard.index');

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard.index');
})->middleware('auth')->name('customer.dashboard.index');

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


// … (route lain di sini) …

// Pastikan user harus login untuk akses ini
Route::middleware(['auth'])->group(function () {
    // Daftar Layanan
    Route::get('/services', [LaundryServiceController::class, 'index'])
         ->name('services.index');
    // Form Tambah Layanan
    Route::get('/services/create', [LaundryServiceController::class, 'create'])
         ->name('services.create');
    // Simpan Layanan (POST)
    Route::post('/services', [LaundryServiceController::class, 'store'])
         ->name('services.store');
    // Form Edit Layanan (GET)
    Route::get('/services/{id}/edit', [LaundryServiceController::class, 'edit'])
         ->name('services.edit');
    // Update Layanan (PUT / PATCH)
    Route::put('/services/{id}', [LaundryServiceController::class, 'update'])
         ->name('services.update');
    // Hapus Layanan (DELETE)
    Route::delete('/services/{id}', [LaundryServiceController::class, 'destroy'])
         ->name('services.destroy');
});





Route::resource('orders', OrderController::class);


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');