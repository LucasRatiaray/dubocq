<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin'],
            ['name' => 'Administrateur'],
            ['name' => 'Conducteur'],
            ['name' => 'Salarié'],
            ['name' => 'Utilisateur'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
