    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\API\OrderController;
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

    Route::get('/riwayat-customer', [OrderController::class, 'history'])->name('customer.riwayat.riwayat');
    Route::get('/orders/{id}/detail', [OrderController::class, 'showDetail'])->name('orders.showDetail');
    Route::get('/ulasan-customer/{orderId}', [\App\Http\Controllers\API\OrderController::class, 'review'])->name('customer.ulasan');

    Route::get('/provider/list', [LaundryProviderController::class, 'index'])->name('provider.list');


Route::middleware(['auth'])->group(function () {
    // 1. Halaman Daftar Layanan (Web)
    Route::get('/services', [LaundryServiceController::class, 'index'])
         ->name('services.index');

    // 2. Form Tambah Layanan (Web)
    Route::get('/services/create', [LaundryServiceController::class, 'create'])
         ->name('services.create');

    // 3. Simpan Layanan (POST dari form)
    Route::post('/services', [LaundryServiceController::class, 'store'])
         ->name('services.store');

    // 4. Form Edit Layanan (Web)
    Route::get('/services/{id}/edit', [LaundryServiceController::class, 'edit'])
         ->name('services.edit');

    // 5. Update Layanan (PUT/PATCH dari form)
    Route::put('/services/{id}', [LaundryServiceController::class, 'update'])
         ->name('services.update');

    // 6. Hapus Layanan (DELETE dari form)
    Route::delete('/services/{id}', [LaundryServiceController::class, 'destroy'])
         ->name('services.destroy');
});




Route::resource('orders', OrderController::class);


    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');