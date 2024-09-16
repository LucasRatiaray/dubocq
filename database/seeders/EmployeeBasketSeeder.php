<?php

namespace Database\Seeders;

use App\Models\Employee;
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
        // Récupérer tous les employés
        $employees = Employee::all();

        // Boucle à travers chaque employé et créer une entrée dans employee_baskets
        foreach ($employees as $employee) {
            EmployeeBasket::create([
                'employee_id' => $employee->id,
            ]);
        }
    }
}
