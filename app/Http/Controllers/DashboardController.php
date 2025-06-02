<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\LaundryService;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index(){
    $ordersTotalToday = Order::whereDate('created_at', today())->count();
    $ordersTotal = Order::count();
    $ordersDone = Order::where('status', 'done')->count();
    $ordersProcess = Order::where('status', 'process')->count();
    $services = LaundryService::all();
    $reviews = Review::all();

    return view('laundry.dashboard.index', compact(
        'ordersTotalToday',
        'ordersTotal',
        'ordersDone',
        'ordersProcess',
        'services',
        'reviews'
    ));
}
}