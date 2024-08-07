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
            ['employee_id' => 1, 'project_id' => 1, 'description' => null],
            ['employee_id' => 2, 'project_id' => 1, 'description' => null],
            ['employee_id' => 3, 'project_id' => 1, 'description' => null]
        ]);
    }
}
