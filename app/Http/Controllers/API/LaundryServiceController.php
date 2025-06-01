<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaundryServiceController extends Controller
{
    // Menampilkan semua layanan laundry (halaman Web)
    public function index()
    {
        // Ambil semua record dari tabel laundry_services
        $services = LaundryService::all();
        // Tampilkan view resources/views/laundry/services/index.blade.php
        return view('laundry.services.index', compact('services'));
    }

    // Menampilkan form tambah layanan (halaman Web)
    public function create()
    {
        return view('laundry.services.create');
    }

    // Menyimpan layanan laundry baru (dari form Web)
    public function store(Request $request)
    {
        // 1) Validasi input service_name & price_per_kg & gambar (opsional)
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
            'image'        => 'nullable|image|max:2048',
        ]);

        // 2) Handle upload gambar: simpan di storage/app/public/services
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
        }

        // 3) Simpan ke database
        LaundryService::create([
            'service_name' => $request->service_name,
            'price_per_kg' => $request->price_per_kg,
            'image_path'   => $path,
        ]);

        // 4) Redirect ke /services dengan flash message
        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    // Menampilkan form edit layanan (halaman Web)
    public function edit($id)
    {
        $service = LaundryService::findOrFail($id);
        return view('laundry.services.edit', compact('service'));
    }

    // Update layanan laundry (dari form Web)
    public function update(Request $request, $id)
    {
        $service = LaundryService::findOrFail($id);

        // Validasi
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
            'image'        => 'nullable|image|max:2048',
        ]);

        // Jika ada gambar baru, hapus gambar lama lalu simpan yang baru
        if ($request->hasFile('image')) {
            if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
                Storage::disk('public')->delete($service->image_path);
            }
            $service->image_path = $request->file('image')->store('services', 'public');
        }

        // Update service_name & price_per_kg
        $service->service_name = $request->service_name;
        $service->price_per_kg = $request->price_per_kg;
        $service->save();

        // Redirect dengan flash message
        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    // Menghapus layanan laundry (dari tombol Delete di Web)
    public function destroy($id)
    {
        $service = LaundryService::findOrFail($id);

        // Hapus file gambar jika ada
        if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
            Storage::disk('public')->delete($service->image_path);
        }
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
