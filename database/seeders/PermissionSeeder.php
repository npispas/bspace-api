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
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Reservation wise permissions
        Permission::create(['name' => 'create reservations']);
        Permission::create(['name' => 'edit reservations']);
        Permission::create(['name' => 'delete reservations']);

        // Room wise permissions
        Permission::create(['name' => 'create rooms']);
        Permission::create(['name' => 'edit rooms']);
        Permission::create(['name' => 'delete rooms']);
    }
}
