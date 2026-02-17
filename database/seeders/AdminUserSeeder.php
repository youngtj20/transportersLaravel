<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@transportersfortinubu.ng',
            'password' => bcrypt('AdminPass123!'),
            'role' => 'admin',
        ]);

        // Create a regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@transportersfortinubu.ng',
            'password' => bcrypt('UserPass123!'),
            'role' => 'user',
        ]);
    }
}
