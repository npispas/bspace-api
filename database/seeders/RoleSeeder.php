<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Role
        $userRole = Role::create([
            'name' => 'user'
        ]);

        // Staff Role
        $staffRole = Role::create([
            'name' => 'staff'
        ]);

        // Admin Role
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        // User Role permissions
        $userRole->givePermissionTo('create_reservations');

        // Staff Role permissions
        $staffRole->givePermissionTo('create_reservations');
        $staffRole->givePermissionTo('edit_reservations');
        $staffRole->givePermissionTo('delete_reservations');
        $staffRole->givePermissionTo('create_rooms');
        $staffRole->givePermissionTo('edit_rooms');
        $staffRole->givePermissionTo('delete_rooms');

        // Admin Role permissions
        $adminRole->givePermissionTo('create_users');
        $adminRole->givePermissionTo('edit_users');
        $adminRole->givePermissionTo('delete_users');
    }
}
