<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // User wise permissions
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'edit_users']);
        Permission::create(['name' => 'delete_users']);

        // Reservation wise permissions
        Permission::create(['name' => 'create_reservations']);
        Permission::create(['name' => 'edit_reservations']);
        Permission::create(['name' => 'delete_reservations']);

        // Room wise permissions
        Permission::create(['name' => 'create_rooms']);
        Permission::create(['name' => 'edit_rooms']);
        Permission::create(['name' => 'delete_rooms']);
    }
}
