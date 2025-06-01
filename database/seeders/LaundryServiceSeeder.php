<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaundryService;

class LaundryServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'laundryProviders' => 1,
                'service_name' => 'Cuci Setrika',
                'price_per_kg' => 7500.00,
            ],
            [
                'laundryProviders' => 1,
                'service_name' => 'Cuci Kering',
                'price_per_kg' => 5000.00,
            ],
            [
                'laundryProviders' => 1,
                'service_name' => 'Setrika Saja',
                'price_per_kg' => 4000.00,
            ],
            [
                'laundryProviders' => 1,
                'service_name' => 'Cuci Setrika',
                'price_per_kg' => 8000.00,
            ],
            [
                'laundryProviders' => 1,
                'service_name' => 'Cuci Ekspres',
                'price_per_kg' => 10000.00,
            ],
            [
                'laundryProviders' => 1,
                'service_name' => 'Cuci Setrika',
                'price_per_kg' => 6500.00,
            ],
        ];

        foreach ($services as $service) {
            LaundryService::create($service);
        }
    }
}
