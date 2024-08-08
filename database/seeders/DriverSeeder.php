<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            ['last_name' => 'DEBRAY', 'first_name' => 'Eric'],
            ['last_name' => 'DUBOCQ', 'first_name' => 'Mickael'],
            ['last_name' => 'DUBOCQ', 'first_name' => 'Philippe'],
            ['last_name' => 'FERREIRA DE ALMEIDA', 'first_name' => 'Gilles'],
            ['last_name' => "GRASSIN D'ALPHONSE", 'first_name' => 'Geoffroy'],
            ['last_name' => 'PELLETIER', 'first_name' => 'Bruno'],
            ['last_name' => 'POCHON', 'first_name' => 'Cyril'],
            ['last_name' => 'RIBEIRO FERNANDES', 'first_name' => 'Carlos'],
            ['last_name' => 'THEVRET', 'first_name' => 'Antoine'],
            ['last_name' => 'WILHELEM', 'first_name' => 'Stanislas'],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
