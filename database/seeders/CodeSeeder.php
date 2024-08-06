<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codes = [
            119018, 121004, 122006, 122011, 122013, 123002, 123008, 123010, 123012, 123013, 123014, 124001,
            124001, 124001, 124001, 124001, 124001, 124001, 124001, 124001, 124001, 124001, 124002, 124003,
            124004, 124005, 124006, 124007, 124008, 220001, 220002, 221001, 222002, 222007, 222008, 223008,
            223009, 223010, 223011, 223014, 223015, 223016, 223017, 224001, 224002, 224003, 224004, 224005,
            224006, 224007, 224008, 224009, 224010, 224011, 224012
        ];

        foreach ($codes as $code) {
            $description = null;
            if (str_starts_with($code, '1')) {
                $description = 'MH';
            } elseif (str_starts_with($code, '2')) {
                $description = 'Logement neuf';
            }
            DB::table('codes')->insert([
                'code' => $code,
                'description' => $description,
            ]);
        }
    }
}
