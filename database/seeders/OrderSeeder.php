<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'user_id'         => 1,
                'laundryProvider' => 1,
                'laundryService'  => 1,
                'pickup_date'     => Carbon::now()->addDays(1),
                'status'          => 'process',
                'quantity'        => 5,
                'total_price'     => 35000,
                'created_at'      => Carbon::now()->subDays(2),
            ],
            [
                'user_id'         => 1,
                'laundryProvider' => 1,
                'laundryService'  => 1,
                'pickup_date'     => Carbon::now()->addDays(2),
                'status'          => 'done',
                'quantity'        => 3,
                'total_price'     => 21000,
                'created_at'      => Carbon::now()->subDays(1),
            ],
            [
                'user_id'         => 1,
                'laundryProvider' => 1,
                'laundryService'  => 1,
                'pickup_date'     => Carbon::now(),
                'status'          => 'process',
                'quantity'        => 2,
                'total_price'     => 14000,
                'created_at'      => Carbon::now(),
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}