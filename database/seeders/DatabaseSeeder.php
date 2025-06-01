<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            LaundryProviderSeeder::class,  // ← Pindahkan ke atas
            LaundryServiceSeeder::class,   // ← Setelah provider
            UsersTableSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
