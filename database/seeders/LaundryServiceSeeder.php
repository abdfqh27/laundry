<?php

namespace Database\Seeders;

use App\Models\LaundryService;
use Illuminate\Database\Seeder;

class LaundryServiceSeeder extends Seeder
{
    public function run(): void
    {
        LaundryService::create([
            'name' => 'Cuci Biasa',
            'description' => 'Pencucian baju biasa dengan deterjen standar',
            'price' => 5000,
            'unit' => 'kg',
            'is_active' => true,
        ]);

        LaundryService::create([
            'name' => 'Cuci Express',
            'description' => 'Pencucian kilat dalam 24 jam',
            'price' => 7000,
            'unit' => 'kg',
            'is_active' => true,
        ]);

        LaundryService::create([
            'name' => 'Dry Clean',
            'description' => 'Pencucian kering untuk bahan khusus',
            'price' => 10000,
            'unit' => 'kg',
            'is_active' => true,
        ]);

        LaundryService::create([
            'name' => 'Setrika',
            'description' => 'Layanan setrika saja',
            'price' => 3000,
            'unit' => 'kg',
            'is_active' => true,
        ]);
    }
}