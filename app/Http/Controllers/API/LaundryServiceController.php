<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LaundryServiceController extends Controller
{
    // Menampilkan semua layanan laundry
    public function index()
    {
        $services = LaundryService::with('provider')->get();
         return view('laundry.services.index', compact('services'));
    }

    // Menyimpan layanan laundry baru
    public function store(Request $request)
    {
        $request->validate([
            'laundryProviders' => 'required|exists:laundry_providers,laundryProvider',
            'service_name' => 'required',
            'price_per_kg' => 'required|numeric|min:0'
        ]);

        $service = LaundryService::create($request->all());

        return response()->json([
            'message' => 'Laundry service created successfully',
            'data' => $service
        ], 201);
    }

    // Mengupdate layanan laundry
    public function update(Request $request, $id)
    {
        $service = LaundryService::find($id);
        if (!$service) {
            return response()->json(['message' => 'Laundry service not found'], 404);
        }

        $request->validate([
            'laundryProviders' => 'sometimes|exists:laundry_providers,laundryProvider',
            'service_name' => 'sometimes|required',
            'price_per_kg' => 'sometimes|required|numeric|min:0'
        ]);

        $service->update($request->all());

        return response()->json([
            'message' => 'Laundry service updated successfully',
            'data' => $service
        ]);
    }

    // Menghapus layanan laundry
    public function destroy($id)
    {
        $service = LaundryService::find($id);
        if (!$service) {
            return response()->json(['message' => 'Laundry service not found'], 404);
        }

        $service->delete();

        return response()->json([
            'message' => 'Laundry service deleted successfully'
        ]);
    }
}
