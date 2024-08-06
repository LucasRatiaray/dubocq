<?php

namespace Database\Seeders;

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
        DB::table('zones')->insert([
            ['name' => 'Zone 1', 'kmRange' => '0-10 KM', 'tariff' => 1.75],
            ['name' => 'Zone 2', 'kmRange' => '11-20 KM', 'tariff' => 2.50],
            ['name' => 'Zone 3', 'kmRange' => '21-30 KM', 'tariff' => 3.75],
            ['name' => 'Zone 4', 'kmRange' => '31-40 KM', 'tariff' => 5.50],
            ['name' => 'Zone 5', 'kmRange' => '41-50 KM', 'tariff' => 6.50],
            ['name' => 'Zone 6', 'kmRange' => '51-60 KM', 'tariff' => 7.30],
            ['name' => 'Zone 7', 'kmRange' => '60+ KM', 'tariff' => 8.80],
        ]);
    }
}
