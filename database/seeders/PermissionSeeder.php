<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-order',
            'edit-order',
            'delete-order',
            'create-review',
            'edit-review',
            'delete-review',
            'create-provider',
            'edit-provider',
            'delete-provider',
            'create-service',
            'edit-service',
            'delete-service'
        ];
        // Looping and Inserting Array's Permissions into Permission
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}