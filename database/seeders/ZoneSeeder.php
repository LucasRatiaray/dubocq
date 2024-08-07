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
            ['name' => 'Zone 1 b', 'kilometersRange' => '0', 'tariff' => 1.75],
            ['name' => 'Zone 2', 'kilometersRange' => '1-10', 'tariff' => 2.50],
            ['name' => 'Zone 3', 'kilometersRange' => '11-20', 'tariff' => 3.75],
            ['name' => 'Zone 4', 'kilometersRange' => '21-30', 'tariff' => 5.50],
            ['name' => 'Zone 5', 'kilometersRange' => '31-40', 'tariff' => 6.50],
            ['name' => 'Zone 6', 'kilometersRange' => '41-50', 'tariff' => 7.30],
            ['name' => 'Zone 7', 'kilometersRange' => '51+', 'tariff' => 8.80],
        ]);
    }
}
