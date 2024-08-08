<?php

namespace Database\Seeders;

use App\Models\BasketZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasketZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basketsZones = [
            ['zone_id' => 1, 'basket_zone' => 1.75],
            ['zone_id' => 2, 'basket_zone' => 2.50],
            ['zone_id' => 3, 'basket_zone' => 3.75],
            ['zone_id' => 4, 'basket_zone' => 4.50],
            ['zone_id' => 5, 'basket_zone' => 5.50],
            ['zone_id' => 6, 'basket_zone' => 7.30],
            ['zone_id' => 7, 'basket_zone' => 8.80],
        ];

        foreach ($basketsZones as $basketZone) {
            BasketZone::create($basketZone);
        }
    }
}
