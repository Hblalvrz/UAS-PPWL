<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use Illuminate\Http\Request;

class LaundryServiceController extends Controller
{
    /**
     * 1) Menampilkan seluruh layanan:
     *    - Jika request web (HTML), kembalikan view 'laundry.services.index'
     *    - Jika request API (JSON), kembalikan JSON array
     */
    public function index(Request $request)
    {
        $services = LaundryService::all();

        if ($request->wantsJson()) {
            return response()->json($services);
        }

        // Jika tidak mau JSON, berarti browser: return view
        return view('laundry.services.index', compact('services'));
    }

    /**
     * 2) Menampilkan form tambah layanan (hanya untuk Web/HTML).
     *    Jika API-mau-JSON memanggil route ini (tidak seharusnya), kita bisa
     *    kembalikan 404 atau pesan JSON.
     */
    public function create(Request $request)
    {
        // Jika datang sebagai API (wantsJson), kembalikan error JSON:
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Endpoint ini untuk form HTML, tidak untuk API.'
            ], 404);
        }

        // Web: kembalikan view create
        return view('laundry.services.create');
    }

    /**
     * 3) Simpan layanan baru:
     *    - Jika request JSON, return JSON (API) seperti semula.
     *    - Jika request form (HTML), simpan, lalu redirect ke index dengan flash message.
     */
    public function store(Request $request)
    {
        // Validasi umum (service_name, price_per_kg, optional image)
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle upload image jika ada
        $path = null;
        if ($request->hasFile('image')) {
            // File akan tersimpan di storage/app/public/services
            $path = $request->file('image')->store('services', 'public');
        }

        // Simpan data baru
        $service = new LaundryService();
        $service->service_name = $request->service_name;
        $service->price_per_kg = $request->price_per_kg;
        $service->image_path = $path; // Pastikan di DB ada kolom image_path
        $service->save();

        // Jika request ingin JSON, kembalikan JSON:
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Layanan berhasil ditambahkan (API).',
                'data' => $service
            ], 201);
        }

        // Jika form HTML: redirect ke /services dengan flash message
        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * 4) Menampilkan detail satu layanan (untuk Web),
     *    atau JSON (untuk API).
     */
    public function show(Request $request, $id)
    {
        $service = LaundryService::find($id);
        if (!$service) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
            }
            abort(404);
        }

        if ($request->wantsJson()) {
            return response()->json($service);
        }

        // Web: kembalikan view detail (jika Anda punya), 
        // tapi kalau tidak ada view show, kita redirect ke index
        return redirect()->route('services.index');
    }

    /**
     * 5) Menampilkan form edit (prefill) (untuk Web).
     *    Jika API memanggil, kembalikan data JSON saja.
     */
    public function edit(Request $request, $id)
    {
        $service = LaundryService::find($id);
        if (!$service) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
            }
            abort(404);
        }

        // Jika API (JSON): kembalikan objek layanan
        if ($request->wantsJson()) {
            return response()->json($service);
        }

        // Jika Web: return view edit.blade.php dengan data $service
        return view('laundry.services.edit', compact('service'));
    }

    /**
     * 6) Update layanan (untuk Web+API).
     */
    public function update(Request $request, $id)
    {
        $service = LaundryService::find($id);
        if (!$service) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
            }
            abort(404);
        }

        // Validasi
        $request->validate([
            'service_name' => 'sometimes|required|string|max:255',
            'price_per_kg' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // Jika ada upload image baru, hapus image lama (opsional):
        if ($request->hasFile('image')) {
            // Hapus file lama, jika ada
            if ($service->image_path && \Storage::disk('public')->exists($service->image_path)) {
                \Storage::disk('public')->delete($service->image_path);
            }
            $path = $request->file('image')->store('services', 'public');
            $service->image_path = $path;
        }

        // Update fields
        if ($request->filled('service_name')) {
            $service->service_name = $request->service_name;
        }
        if ($request->filled('price_per_kg')) {
            $service->price_per_kg = $request->price_per_kg;
        }
        $service->save();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Layanan berhasil diperbarui (API).',
                'data' => $service
            ]);
        }

        // Jika Web: redirect kembali ke index
        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * 7) Hapus layanan (untuk Web + API).
     */
    public function destroy(Request $request, $id)
    {
        $service = LaundryService::find($id);
        if (!$service) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
            }
            abort(404);
        }

        // Hapus image file jika ada
        if ($service->image_path && \Storage::disk('public')->exists($service->image_path)) {
            \Storage::disk('public')->delete($service->image_path);
        }
        $service->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Layanan berhasil dihapus (API).']);
        }

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
