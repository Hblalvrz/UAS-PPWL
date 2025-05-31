<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\LaundryProvider;
use App\Models\LaundryService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'provider', 'service']);
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {

                $userColumns = \Schema::getColumnListing('users');
                $searchableUserColumns = array_intersect($userColumns, [
                    'name', 'username', 'full_name', 'first_name', 'last_name', 'email'
                ]);
                
                if (!empty($searchableUserColumns)) {
                    $q->whereHas('user', function($userQuery) use ($searchTerm, $searchableUserColumns) {
                        $userQuery->where(function($subQuery) use ($searchTerm, $searchableUserColumns) {
                            foreach ($searchableUserColumns as $column) {
                                $subQuery->orWhere($column, 'like', '%' . $searchTerm . '%');
                            }
                        });
                    });
                }
                
                $serviceColumns = \Schema::getColumnListing('laundry_services');
                $searchableServiceColumns = array_intersect($serviceColumns, [
                    'name', 'service_name', 'title', 'description', 'type'
                ]);
                
                if (!empty($searchableServiceColumns)) {
                    $q->orWhereHas('service', function($serviceQuery) use ($searchTerm, $searchableServiceColumns) {
                        $serviceQuery->where(function($subQuery) use ($searchTerm, $searchableServiceColumns) {
                            foreach ($searchableServiceColumns as $column) {
                                $subQuery->orWhere($column, 'like', '%' . $searchTerm . '%');
                            }
                        });
                    });
                }
            });
        }
        
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }
        
        // Urutkan berdasarkan created_at (tanggal order) terbaru
        $orders = $query->latest('created_at')->get();
        
        return view('laundry.orders.index', compact('orders'));
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
            'user_id' => 'required|exists:users,user_id',
            'laundryProvider' => 'required|exists:laundry_providers,laundryProvider',
            'laundryService' => 'required|exists:laundry_services,laundryService',
            'pickup_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:process,done',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0'
        ]);

        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

    public function show($id)
    {
        $order = Order::with(['user', 'provider', 'service'])->findOrFail($id);
        return view('laundry.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        $providers = LaundryProvider::all();
        $services = LaundryService::all();
        return view('laundry.orders.edit', compact('order', 'users', 'providers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'laundryProvider' => 'required|exists:laundry_providers,laundryProvider',
            'laundryService' => 'required|exists:laundry_services,laundryService',
            'pickup_date' => 'required|date',
            'status' => 'required|in:process,done',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0'
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
