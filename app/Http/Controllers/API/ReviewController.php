<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Menampilkan semua review
    public function index()
    {
        $reviews = Review::with(['user', 'provider'])->get();
        return view('customer.riwayat.ulasan', compact('reviews'));
    }

    // Menyimpan review baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,user_id',
            'laundryProviders'  => 'required|exists:laundry_providers,laundryProvider',
            'value'             => 'required|integer|min:1|max:5',
            'contents'          => 'required'
        ]);

        $review = Review::create($request->all());

        return redirect()->route('customer.riwayat.riwayat')->with('success', 'Ulasan berhasil dibuat!');
    }

    // Mengupdate review
    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $request->validate([
            'user_id'           => 'sometimes|exists:users,user_id',
            'laundryProviders'  => 'sometimes|exists:laundry_providers,laundryProvider',
            'status'            => 'sometimes|in:pending,reject,accepted',
            'value'             => 'sometimes|integer|min:1|max:5',
            'contents'          => 'sometimes|required'
        ]);

        $review->update($request->all());

        return response()->json([
            'message' => 'Review updated successfully',
            'data'    => $review
        ]);
    }

    // Menghapus review
    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
}
