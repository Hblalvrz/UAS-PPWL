<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaundryProvider;

class LaundryProviderSeeder extends Seeder
{
    public function run()
    {
        $providers = [
            [
                'laundry_name' => 'Fuad Laundry',
                'address' => 'Sungai Ngawi No. 69',
                'description' => 'Laundry terbaik dengan pelayanan cepat dan hasil memuaskan.',
                'phone' => '+6269694646',
            ],
            [
                'laundry_name' => 'Bersih Laundry',
                'address' => 'Jl. Merdeka No. 10',
                'description' => 'Pelayanan ramah dan harga terjangkau.',
                'phone' => '+628123456789',
            ],
            [
                'laundry_name' => 'Cahaya Laundry',
                'address' => 'Jl. Sudirman No. 45',
                'description' => 'Cepat, bersih, dan terpercaya.',
                'phone' => '+628987654321',
            ],
        ];

        foreach ($providers as $provider) {
            LaundryProvider::create($provider);
        }
    }
}
