<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->line('Email: admin@admin.com');
            $this->command->line('Password: password123');
        } else {
            $this->command->info('Admin user already exists.');
        }

        // Create a regular test user if it doesn't exist
        if (!User::where('email', 'user@test.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'user@test.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);

            $this->command->info('Test user created successfully!');
            $this->command->line('Email: user@test.com');
            $this->command->line('Password: password123');
        } else {
            $this->command->info('Test user already exists.');
        }
    }
}
