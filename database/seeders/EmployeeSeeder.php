<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['last_name' => 'AYEB', 'first_name' => 'Mounir', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2000],
            ['last_name' => 'BACCOUCHE', 'first_name' => 'Mohamed', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2000],
            ['last_name' => 'BACCOUCHE', 'first_name' => 'Mohamed', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2000],
            ['last_name' => 'BARRETO', 'first_name' => 'Alcindo', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2000],
            ['last_name' => 'BEITO AMORIN', 'first_name' => 'Rui', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2000],
            ['last_name' => 'BOUTONNET', 'first_name' => 'Lucas', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2000],
            ['last_name' => 'BOUTONNET', 'first_name' => 'Lucas', 'status' => 'OUVRIER', 'contract' => '35', 'monthly_salary' => 2000],
            ['last_name' => 'BOUTONNET', 'first_name' => 'Lucas', 'status' => 'OUVRIER', 'contract' => '40', 'monthly_salary' => 2000],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
