<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaundryProviderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('laundry_providers')->insert([
            [
                'laundryProvider' => 1,  // ← Pastikan ini ada
                'name' => 'Clean & Fresh Laundry',
                'address' => 'Jl. Sudirman No. 123',
                'phone' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'laundryProvider' => 2,
                'name' => 'Express Wash',
                'address' => 'Jl. Thamrin No. 456',
                'phone' => '081298765432',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
