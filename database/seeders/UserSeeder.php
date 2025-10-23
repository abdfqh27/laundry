<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@laundry.com',
            'phone' => '081234567890',
            'role' => 'administrator',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@laundry.com',
            'phone' => '081234567891',
            'role' => 'karyawan',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'customer@laundry.com',
            'phone' => '081234567892',
            'address' => 'Jl. Merdeka No. 1',
            'role' => 'customer',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);
    }
}