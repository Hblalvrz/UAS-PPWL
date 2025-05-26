<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()
    {
        $orders = Order::with(['user', 'provider', 'service'])->get();
        return response()->json($orders);
    }

    // Menyimpan order baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,user_id',
            'laundryProvider'   => 'required|exists:laundry_providers,laundryProvider',
            'laundryService'    => 'required|exists:laundry_services,laundryService',
            'pickup_date'       => 'required|date',
            'status'            => 'required|in:process,done',
            'quantity'          => 'required|integer|min:1',
            'total_price'       => 'required|numeric|min:0'
        ]);

        $order = Order::create($request->all());

        return response()->json([
            'message' => 'Order created successfully',
            'data'    => $order
        ], 201);
    }

    // Mengupdate order
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'user_id'           => 'sometimes|exists:users,user_id',
            'laundryProvider'   => 'sometimes|exists:laundry_providers,laundryProvider',
            'laundryService'    => 'sometimes|exists:laundry_services,laundryService',
            'pickup_date'       => 'sometimes|date',
            'status'            => 'sometimes|in:process,done',
            'quantity'          => 'sometimes|integer|min:1',
            'total_price'       => 'sometimes|numeric|min:0'
        ]);

        $order->update($request->all());

        return response()->json([
            'message' => 'Order updated successfully',
            'data'    => $order
        ]);
    }

    // Menghapus order
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully'
        ]);
    }

    // Menampilkan detail order tertentu
    public function show($id)
    {
        $order = Order::with(['user', 'provider', 'service'])->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }
}
