<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee_projects')->insert([
            ['employeeId' => 1, 'projectId' => 1, 'description' => null],
            ['employeeId' => 2, 'projectId' => 1, 'description' => null],
            ['employeeId' => 3, 'projectId' => 1, 'description' => null]
        ]);
    }
}
