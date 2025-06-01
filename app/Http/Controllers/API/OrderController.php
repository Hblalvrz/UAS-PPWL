<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaundryProvider;
use App\Models\LaundryService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua order
    public function index()
    {
        $orders = Order::with(['user', 'provider', 'service'])->get();
        return view('laundry.orders.index', compact('orders'));
    }

    // Tambahkan method ini di OrderController
    public function history()
    {
        // Ambil order berdasarkan user yang login
        $orders = Order::with(['provider', 'service'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.riwayat.riwayat', compact('orders'));
    }

    public function showDetail($id)
    {
        $orderDetail = Order::with(['user', 'provider', 'service'])->find($id);
        if (!$orderDetail) {
            abort(404);
        }
        return view('customer.riwayat.detail', compact('orderDetail'));
    }

    public function create($providerId)
    {
        $providers = LaundryProvider::with('services')->get();
        return view('customer.cari.order', compact('providers'));
    }

    // Menyimpan order baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,user_id',
            'laundryProvider'   => 'required|exists:laundry_providers,laundryProvider',
            'laundryService'    => 'required|exists:laundry_services,laundryService',
            'quantity'          => 'required|integer|min:1',
            'total_price'       => 'required|numeric|min:0'
        ]);

        $service = LaundryService::find($request->laundryService);

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

    // Menampilkan halaman ulasan untuk order tertentu
    public function review($orderId)
    {
        $order = Order::with(['provider', 'service'])->find($orderId);
        if (!$order) {
            abort(404);
        }
        return view('customer.riwayat.ulasan', compact('order'));
    }
}
