<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@rental.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    
        User::create([
            'name' => 'Owner User',
            'email' => 'owner@rental.com',
            'password' => Hash::make('owner123'),
            'role' => 'owner',
        ]);
    
        User::create([
            'name' => 'Renter User',
            'email' => 'renter@rental.com',
            'password' => Hash::make('renter123'),
            'role' => 'renter',
        ]);
    }
}
