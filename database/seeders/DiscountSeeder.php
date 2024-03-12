<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //manual input
        Discount::create([
            'name' => 'Welcome WCB',
            'description' => 'Member baru WCB',
            'type' => 'percentage',
            'value' => 20,
            'status' => 'active',
            'expired_date' => '2025-01-31'
        ]);

        Discount::create([
            'name' => 'New Year',
            'description' => 'Discount New Year',
            'type' => 'percentage',
            'value' => 10,
            'status' => 'active',
            'expired_date' => '2025-01-07'
        ]);

        Discount::create([
            'name' => 'Black Friday',
            'description' => 'Discount Black Friday',
            'type' => 'percentage',
            'value' => 15,
            'status' => 'active',
            'expired_date' => '2025-12-31'
        ]);
    }
}