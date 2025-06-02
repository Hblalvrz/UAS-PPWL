<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use App\Models\LaundryProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaundryServiceController extends Controller
{
    // Menampilkan semua layanan laundry (halaman Web)
    public function index()
    {
        // Ambil semua record dengan relasi laundryProvider
        $services = LaundryService::with('laundryProvider')->get();
        return view('laundry.services.index', compact('services'));
    }

    // Menampilkan form tambah layanan (halaman Web)
    public function create()
    {
        // Tidak perlu laundryProviders karena tidak ada dropdown
        return view('laundry.services.create');
    }

    // Menyimpan layanan laundry baru (dari form Web)
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        // Ambil ID provider pertama yang tersedia
        $defaultProvider = LaundryProvider::first();
        
        if (!$defaultProvider) {
            return redirect()->back()->with('error', 'Tidak ada penyedia laundry tersedia.');
        }

        LaundryService::create([
            'laundryProviders' => $defaultProvider->laundryProvider,
            'service_name' => $request->service_name,
            'price_per_kg' => $request->price_per_kg,
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    // Menampilkan form edit layanan (halaman Web)
    public function edit($id)
    {
        $service = LaundryService::findOrFail($id);
        // Tidak perlu laundryProviders karena tidak ada dropdown
        return view('laundry.services.edit', compact('service'));
    }

    // Update layanan laundry (dari form Web)
    public function update(Request $request, $id)
    {
        $service = LaundryService::findOrFail($id);

        // Validasi tanpa laundryProviders
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        // Update data tanpa mengubah laundryProviders
        $service->update([
            'service_name' => $request->service_name,
            'price_per_kg' => $request->price_per_kg,
        ]);

        // Redirect dengan flash message
        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    // Menghapus layanan laundry (dari tombol Delete di Web)
    public function destroy($id)
    {
        $service = LaundryService::findOrFail($id);
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
