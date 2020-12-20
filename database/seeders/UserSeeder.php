<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the default admin.
        $user = User::create([
            'first_name' => 'Nikolaos',
            'last_name' => 'Pispas',
            'username' => 'npispas',
            'email' => 'npispas@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);

        $adminRole = Role::findByName('admin');

        // Assign admin privileges to the user
        $user->assignRole($adminRole);
    }
}
