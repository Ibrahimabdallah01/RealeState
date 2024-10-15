<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin_user',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'), // Hash the password
                'photo' => 'default_admin_photo.png', // Default photo or keep null
                'phone' => '1234567890',
                'address' => '123 Admin St, Admin City',
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(), // Set to now() for verified
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agent',
                'username' => 'agent_user',
                'email' => 'agent@gmail.com',
                'password' => bcrypt('password'),
                'photo' => null,
                'phone' => '0987654321',
                'address' => '456 Agent St, Agent City',
                'role' => 'agent',
                'status' => 'active',
                'email_verified_at' => null, // Unverified
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'username' => 'regular_user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'photo' => null,
                'phone' => '1112223333',
                'address' => '789 User St, User City',
                'role' => 'user',
                'status' => 'active',
                'email_verified_at' => null, // Unverified
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}