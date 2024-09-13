<?php

namespace Database\Seeders;

use App\Models\EmployeeBasket;
use App\Models\RateCharged;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
//
        $this->call([
            RateChargedSeeder::class,
            ZoneSeeder::class,
            BasketSeeder::class,
            BasketZoneSeeder::class,
            DriverSeeder::class,
            EmployeeSeeder::class,
            EmployeeBasketSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
