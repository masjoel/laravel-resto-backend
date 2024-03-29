<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Masjoel',
            'email' => 'masjoel@gmail.com',
            'password' => Hash::make('123123123'),
        ]);
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            DiscountSeeder::class,
        ]);
    }
}
