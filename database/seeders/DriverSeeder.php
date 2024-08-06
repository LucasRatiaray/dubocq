<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            ['lastname' => 'DEBRAY', 'firstname' => 'Eric'],
            ['lastname' => 'DUBOCQ', 'firstname' => 'Mickael'],
            ['lastname' => 'DUBOCQ', 'firstname' => 'Philippe'],
            ['lastname' => 'FERREIRA DE ALMEIDA', 'firstname' => 'Gilles'],
            ['lastname' => 'GRASSIN D\'ALPHONSE', 'firstname' => 'Geoffroy'],
            ['lastname' => 'PELLETIER', 'firstname' => 'Bruno'],
            ['lastname' => 'POCHON', 'firstname' => 'Cyril'],
            ['lastname' => 'RIBEIRO FERNANDES', 'firstname' => 'Carlos'],
            ['lastname' => 'THEVRET', 'firstname' => 'Antoine'],
            ['lastname' => 'WILHELEM', 'firstname' => 'Stanislas'],
        ];
        DB::table('drivers')->insert($drivers);
    }
}
