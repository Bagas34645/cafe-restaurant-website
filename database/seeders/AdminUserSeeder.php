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
        // Create admin user if doesn't exist
        if (!User::where('email', 'admin@caferestaurant.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@caferestaurant.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@caferestaurant.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
