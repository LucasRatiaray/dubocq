<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HourlyRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hourly_rates')->insert([
            // Alvin Antunes
            ['employee_id' => 1, 'zone_id' => 1, 'rate' => 29.32],
            ['employee_id' => 1, 'zone_id' => 2, 'rate' => 29.49],
            ['employee_id' => 1, 'zone_id' => 3, 'rate' => 29.78],
            ['employee_id' => 1, 'zone_id' => 4, 'rate' => 29.95],
            ['employee_id' => 1, 'zone_id' => 5, 'rate' => 30.18],
            ['employee_id' => 1, 'zone_id' => 6, 'rate' => 30.59],
            ['employee_id' => 1, 'zone_id' => 7, 'rate' => 30.94],
            // Mounir Ayeb
            ['employee_id' => 2, 'zone_id' => 1, 'rate' => 32.75],
            ['employee_id' => 2, 'zone_id' => 2, 'rate' => 32.92],
            ['employee_id' => 2, 'zone_id' => 3, 'rate' => 33.21],
            ['employee_id' => 2, 'zone_id' => 4, 'rate' => 33.38],
            ['employee_id' => 2, 'zone_id' => 5, 'rate' => 33.61],
            ['employee_id' => 2, 'zone_id' => 6, 'rate' => 34.02],
            ['employee_id' => 2, 'zone_id' => 7, 'rate' => 34.37],
            // Alcindo Barreto
            ['employee_id' => 3, 'zone_id' => 1, 'rate' => 43.59],
            ['employee_id' => 3, 'zone_id' => 2, 'rate' => 43.76],
            ['employee_id' => 3, 'zone_id' => 3, 'rate' => 44.05],
            ['employee_id' => 3, 'zone_id' => 4, 'rate' => 44.22],
            ['employee_id' => 3, 'zone_id' => 5, 'rate' => 44.45],
            ['employee_id' => 3, 'zone_id' => 6, 'rate' => 44.86],
            ['employee_id' => 3, 'zone_id' => 7, 'rate' => 45.21]
        ]);
    }
}
