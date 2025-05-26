<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'peran_id' => 1,
                'name' => 'John Customer',
                'phone' => '081234567890',
                'password' => Hash::make('password'),
                'address' => 'Jl. Mawar No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'peran_id' => 2,
                'name' => 'Jane Provider',
                'phone' => '081298765432',
                'password' => Hash::make('password'),
                'address' => 'Jl. Melati No. 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
