<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $customer = Role::create(['name' => 'customer', 'guard_name' => 'web']);
        $laundry =  Role::create(['name' => 'laundry_providers', 'guard_name' => 'web']);

        $customer->givePermissionTo([
            'create-order',
            'edit-order',
            'delete-order',
            'create-review',
            'edit-review',
            'delete-review'
        ]);

        $laundry->givePermissionTo([
            'create-provider',
            'edit-provider',
            'delete-provider',
            'create-service',
            'edit-service',
            'delete-service',
            'edit-order'
        ]);
    }
}
