<?php

namespace Database\Seeders;

use App\Models\RateCharged;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateChargedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RateCharged::create([
            'value' => 70,
        ]);
    }
}
