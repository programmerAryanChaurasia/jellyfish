<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Test@123'),
            'role' => 'admin', // Add role field to users table
            'email_verified_at' => now(),
        ]);

        // Create Editor User (optional)
        User::create([
            'name' => 'Editor User',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('Test@123'),
            'role' => 'editor',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@gmail.com');
        $this->command->info('Password: Test@123');
    }
}