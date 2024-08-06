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
            ['employeeId' => 1, 'zoneId' => 1, 'rate' => 29.32],
            ['employeeId' => 1, 'zoneId' => 2, 'rate' => 29.49],
            ['employeeId' => 1, 'zoneId' => 3, 'rate' => 29.78],
            ['employeeId' => 1, 'zoneId' => 4, 'rate' => 29.95],
            ['employeeId' => 1, 'zoneId' => 5, 'rate' => 30.18],
            ['employeeId' => 1, 'zoneId' => 6, 'rate' => 30.59],
            ['employeeId' => 1, 'zoneId' => 7, 'rate' => 30.94],
            // Mounir Ayeb
            ['employeeId' => 2, 'zoneId' => 1, 'rate' => 32.75],
            ['employeeId' => 2, 'zoneId' => 2, 'rate' => 32.92],
            ['employeeId' => 2, 'zoneId' => 3, 'rate' => 33.21],
            ['employeeId' => 2, 'zoneId' => 4, 'rate' => 33.38],
            ['employeeId' => 2, 'zoneId' => 5, 'rate' => 33.61],
            ['employeeId' => 2, 'zoneId' => 6, 'rate' => 34.02],
            ['employeeId' => 2, 'zoneId' => 7, 'rate' => 34.37],
            // Alcindo Barreto
            ['employeeId' => 3, 'zoneId' => 1, 'rate' => 43.59],
            ['employeeId' => 3, 'zoneId' => 2, 'rate' => 43.76],
            ['employeeId' => 3, 'zoneId' => 3, 'rate' => 44.05],
            ['employeeId' => 3, 'zoneId' => 4, 'rate' => 44.22],
            ['employeeId' => 3, 'zoneId' => 5, 'rate' => 44.45],
            ['employeeId' => 3, 'zoneId' => 6, 'rate' => 44.86],
            ['employeeId' => 3, 'zoneId' => 7, 'rate' => 45.21]
        ]);
    }
}
