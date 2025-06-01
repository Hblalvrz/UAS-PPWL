<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat semua role yang diperlukan
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $customerRole = Role::firstOrCreate([
            'name' => 'customer', 
            'guard_name' => 'web'
        ]);

        $providerRole = Role::firstOrCreate([
            'name' => 'provider',
            'guard_name' => 'web'
        ]);

        // Tambahkan role laundry_providers
        $laundryProvidersRole = Role::firstOrCreate([
            'name' => 'laundry_providers',
            'guard_name' => 'web'
        ]);

        // Assign permissions jika diperlukan
        if (!$laundryProvidersRole->hasPermissionTo('manage-services')) {
            $laundryProvidersRole->givePermissionTo([
                'view-order', 
                'edit-order', 
                'manage-services',
                'view-dashboard'
            ]);
        }
    }
}
