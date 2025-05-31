<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\LaundryProvider;
use App\Models\LaundryService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'provider', 'service'])->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $providers = LaundryProvider::all();
        $services = LaundryService::all();
        return view('orders.create', compact('users', 'providers', 'services'));
    }

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
        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        $providers = LaundryProvider::all();
        $services = LaundryService::all();
        return view('orders.edit', compact('order', 'users', 'providers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'user_id'           => 'required|exists:users,user_id',
            'laundryProvider'   => 'required|exists:laundry_providers,laundryProvider',
            'laundryService'    => 'required|exists:laundry_services,laundryService',
            'pickup_date'       => 'required|date',
            'status'            => 'required|in:process,done',
            'quantity'          => 'required|integer|min:1',
            'total_price'       => 'required|numeric|min:0'
        ]);
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil diupdate!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus!');
    }
}
