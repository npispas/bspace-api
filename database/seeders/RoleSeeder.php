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
        $userRole->givePermissionTo('create reservations');

        // Staff Role permissions
        $staffRole->givePermissionTo('create reservations');
        $staffRole->givePermissionTo('edit reservations');
        $staffRole->givePermissionTo('delete reservations');
        $staffRole->givePermissionTo('create rooms');
        $staffRole->givePermissionTo('edit rooms');
        $staffRole->givePermissionTo('delete rooms');

        // Admin Role permissions
        $adminRole->givePermissionTo('create users');
        $adminRole->givePermissionTo('edit users');
        $adminRole->givePermissionTo('delete users');
    }
}
