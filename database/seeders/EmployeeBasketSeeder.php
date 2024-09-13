<?php

namespace Database\Seeders;

use App\Models\EmployeeBasket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeBasketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeBaskets = [
            [
                'employee_id' => 1,
            ],
            [
                'employee_id' => 2,
            ],
            [
                'employee_id' => 3,
            ],
        ];

        foreach ($employeeBaskets as $employeeBasket) {
            EmployeeBasket::create($employeeBasket);
        }
    }
}
