<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['zone_id' => 1, 'basket37h' => 0.40, 'basket35h' => 0.43],
            ['zone_id' => 2, 'basket37h' => 0.57, 'basket35h' => 0.61],
            ['zone_id' => 3, 'basket37h' => 0.86, 'basket35h' => 0.91],
            ['zone_id' => 4, 'basket37h' => 1.03, 'basket35h' => 1.09],
            ['zone_id' => 5, 'basket37h' => 1.26, 'basket35h' => 1.34],
            ['zone_id' => 6, 'basket37h' => 1.68, 'basket35h' => 1.77],
            ['zone_id' => 7, 'basket37h' => 2.02, 'basket35h' => 2.14],
        ];

        DB::table('baskets')->insert($data);
    }
}
