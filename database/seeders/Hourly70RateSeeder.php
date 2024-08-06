<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Hourly70RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hourly70_rate = [
            ['employeeId' => 1, 'rate' => 29.82],
            ['employeeId' => 2, 'rate' => 40.66],
            ['employeeId' => 3, 'rate' => 26.33],
        ];

        DB::table('hourly70_rates')->insert($hourly70_rate);
    }
}
