<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name' => '1 b', 'kilometers_range_min' => 0, 'kilometers_range_max' => 0, 'tariff' => 1.75],
            ['name' => '2', 'kilometers_range_min' => 1, 'kilometers_range_max' => 10.99, 'tariff' => 2.50],
            ['name' => '3', 'kilometers_range_min' => 11, 'kilometers_range_max' => 20.99, 'tariff' => 3.75],
            ['name' => '4', 'kilometers_range_min' => 21, 'kilometers_range_max' => 30.99, 'tariff' => 5.50],
            ['name' => '5', 'kilometers_range_min' => 31, 'kilometers_range_max' => 40.99, 'tariff' => 6.50],
            ['name' => '6', 'kilometers_range_min' => 41, 'kilometers_range_max' => 50.99, 'tariff' => 7.30],
            ['name' => '7', 'kilometers_range_min' => 51, 'kilometers_range_max' => 9999, 'tariff' => 8.80],
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }
    }
}
