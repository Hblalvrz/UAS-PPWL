<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('peran')->insert([
            ['role_name' => 'customer', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'laundry_providers', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}