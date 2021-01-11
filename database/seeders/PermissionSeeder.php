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
        Permission::create([
            'name' => 'view_users',
            'action' => 'view',
            'subject' => 'User'
        ]);
        Permission::create([
            'name' => 'create_users',
            'action' => 'create',
            'subject' => 'User'
        ]);
        Permission::create([
            'name' => 'edit_users',
            'action' => 'edit',
            'subject' => 'User'
        ]);
        Permission::create([
            'name' => 'delete_users',
            'action' => 'delete',
            'subject' => 'User'
        ]);

        // Reservation wise permissions
        Permission::create([
            'name' => 'view_reservations',
            'action' => 'view',
            'subject' => 'Reservation'
        ]);
        Permission::create([
            'name' => 'create_reservations',
            'action' => 'create',
            'subject' => 'Reservation'
        ]);
        Permission::create([
            'name' => 'edit_reservations',
            'action' => 'edit',
            'subject' => 'Reservation'
        ]);
        Permission::create([
            'name' => 'delete_reservations',
            'action' => 'delete',
            'subject' => 'Reservation'
        ]);

        // Room wise permissions
        Permission::create([
            'name' => 'view_rooms',
            'action' => 'view',
            'subject' => 'Room'
        ]);
        Permission::create([
            'name' => 'create_rooms',
            'action' => 'create',
            'subject' => 'Room'
        ]);
        Permission::create([
            'name' => 'edit_rooms',
            'action' => 'edit',
            'subject' => 'Room'
        ]);
        Permission::create([
            'name' => 'delete_rooms',
            'action' => 'delete',
            'subject' => 'Room'
        ]);
    }
}
