<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaundryServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('laundry_services')->insert([
            [
                'laundryProviders' => 1,  // ← Harus sesuai dengan data provider
                'service_name' => 'Cuci Setrika',
                'price_per_kg' => 7500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'laundryProviders' => 1,
                'service_name' => 'Cuci Kering',
                'price_per_kg' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'laundryProviders' => 2,
                'service_name' => 'Express Wash',
                'price_per_kg' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
