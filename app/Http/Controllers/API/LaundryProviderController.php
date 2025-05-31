<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaundryProvider;
use Illuminate\Http\Request;

class LaundryProviderController extends Controller
{
    // Menampilkan daftar laundry provider (API)
    public function index()
    {
        $providers = LaundryProvider::all();
        return response()->json($providers);
    }

    // Menyimpan laundry provider baru (API)
    public function store(Request $request)
    {
        $request->validate([
            'laundry_name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'phone' => 'required'
        ]);

        $provider = LaundryProvider::create($request->all());

        return response()->json([
            'message' => 'Laundry provider created successfully',
            'data' => $provider
        ], 201);
    }

    // Mengupdate laundry provider (API)
    public function update(Request $request, $id)
    {
        $provider = LaundryProvider::find($id);
        if (!$provider) {
            return response()->json(['message' => 'Laundry provider not found'], 404);
        }

        $request->validate([
            'laundry_name' => 'sometimes|required',
            'address' => 'sometimes|required',
            'description' => 'sometimes|required',
            'phone' => 'sometimes|required'
        ]);

        $provider->update($request->all());

        return response()->json([
            'message' => 'Laundry provider updated successfully',
            'data' => $provider
        ]);
    }

    // Menghapus laundry provider (API)
    public function destroy($id)
    {
        $provider = LaundryProvider::find($id);
        if (!$provider) {
            return response()->json(['message' => 'Laundry provider not found'], 404);
        }

        $provider->delete();

        return response()->json([
            'message' => 'Laundry provider deleted successfully'
        ]);
    }
}
