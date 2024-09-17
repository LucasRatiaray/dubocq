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
            ['last_name' => 'AYEB', 'first_name' => 'Mounir', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2812.46],
            ['last_name' => 'BARRETO', 'first_name' => 'Alcindo', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3834.69],
            ['last_name' => 'BEITO AMORIN', 'first_name' => 'Rui', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2483.62],
            ['last_name' => 'BOUTONNET', 'first_name' => 'Lucas', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 698.90],
            ['last_name' => 'CABRAL ROBALO', 'first_name' => 'Gilson', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3143.40],
            ['last_name' => 'CARVALHO', 'first_name' => 'Jorge', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3017.16],
            ['last_name' => 'CINGOZ', 'first_name' => 'Ahmet', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2635.96],
            ['last_name' => 'COCHAN', 'first_name' => 'Julien', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3388.44],
            ['last_name' => 'COLLINS', 'first_name' => 'Steeve', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2813.16],
            ['last_name' => 'COULIBALY', 'first_name' => 'Faguimba', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2416.38],
            ['last_name' => 'COULIBALY', 'first_name' => 'Lamourou', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2488.87],
            ['last_name' => 'COUVEUR', 'first_name' => 'Dominique', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3017.16],
            ['last_name' => 'DA MOURA', 'first_name' => 'Chirstophe', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 1966.61],
            ['last_name' => 'DA SILVA', 'first_name' => 'Noberto', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3953.41],
            ['last_name' => 'DA SILVA CAMPOS', 'first_name' => 'José', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3327.78],
            ['last_name' => 'DA SILVA SANTOS', 'first_name' => 'Joaquim', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2633.85],
            ['last_name' => 'DA SILVA VAZ', 'first_name' => 'Paulo Jorge', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2712.73],
            ['last_name' => 'DE LIMA FERNANDES', 'first_name' => 'Manuel', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3681.30],
            ['last_name' => 'DE OLIVEIRA MANCO', 'first_name' => 'Rui', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3614.06],
            ['last_name' => 'DE PINA DIAS', 'first_name' => 'Angelo', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3008.92],
            ['last_name' => 'DELAVAUD', 'first_name' => 'Jean Baptiste', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2948.92],
            ['last_name' => 'DEMBELE', 'first_name' => 'Diakou', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 1966.61],
            ['last_name' => 'DIARRA', 'first_name' => 'Mama', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 1966.61],
            ['last_name' => 'DOS SANTOS', 'first_name' => 'elias', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2985.54],
            ['last_name' => 'DUARTE DA MOURA', 'first_name' => 'Alvarino', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3122.00],
            ['last_name' => 'ESNAULT', 'first_name' => 'Nicolas', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3105.90],
            ['last_name' => 'FERNANDES', 'first_name' => 'Ludovic', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3436.00],
            ['last_name' => 'FERNANDES', 'first_name' => 'Christophe', 'status' => 'ETAM', 'contract' => '37', 'monthly_salary' => 4234.97],
            ['last_name' => 'FERNANDES', 'first_name' => 'Antonio', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 4351.59],
            ['last_name' => 'FLORA ALVES', 'first_name' => 'Joao', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3739.09],
            ['last_name' => 'GERMOND', 'first_name' => 'christophe', 'status' => 'ETAM', 'contract' => '37', 'monthly_salary' => 3354.57],
            ['last_name' => 'GOMES', 'first_name' => 'Domingos', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 5739.43],
            ['last_name' => 'GOMES PACHECO', 'first_name' => 'José Manuel', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3507.94],
            ['last_name' => 'GONCALVES', 'first_name' => 'Jorge', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3463.92],
            ['last_name' => 'GOURDON', 'first_name' => 'Guillaume', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3478.54],
            ['last_name' => 'KAPUSUK', 'first_name' => 'Férit', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2800.90],
            ['last_name' => 'LOPES', 'first_name' => 'Sergio', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2346.00],
            ['last_name' => 'LOURENCO', 'first_name' => 'Paulo', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2877.82],
            ['last_name' => 'MAGASSA', 'first_name' => 'Cheikhou', 'status' => 'ETAM', 'contract' => '37', 'monthly_salary' => 2416.38],
            ['last_name' => 'MALHEIRO', 'first_name' => 'Carlos', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3767.00],
            ['last_name' => 'MARASLIOGLU', 'first_name' => 'Tacettin', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3370.28],
            ['last_name' => 'MARTINEZ', 'first_name' => 'Cyril', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3060.00],
            ['last_name' => 'MENDES DE BRITO', 'first_name' => 'Joao', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2684.00],
            ['last_name' => 'MICHAUT', 'first_name' => 'Stéphane', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2451.42],
            ['last_name' => 'NOEL', 'first_name' => 'Théo', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 1397.79],
            ['last_name' => 'OUERFELLI', 'first_name' => 'Rayyan', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 936.04],
            ['last_name' => 'OZDAMAR', 'first_name' => 'Ahmet', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2696.00],
            ['last_name' => 'PASSEIRA', 'first_name' => 'Joao', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3187.50],
            ['last_name' => 'PINTO DA SILVA', 'first_name' => 'Antonino', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3320.43],
            ['last_name' => 'POUPRY', 'first_name' => 'Alexandre', 'status' => 'ETAM', 'contract' => '37', 'monthly_salary' => 3001.96],
            ['last_name' => 'RODRIGUES', 'first_name' => 'David', 'status' => 'ETAM', 'contract' => '37', 'monthly_salary' => 3838.24],
            ['last_name' => 'RODRIGUES', 'first_name' => 'Noé', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3838.24],
            ['last_name' => 'SEMEDO MOREIRA', 'first_name' => 'Eusébio', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2304.05],
            ['last_name' => 'SEMEDO CABRAL', 'first_name' => 'Félisberto', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3142.00],
            ['last_name' => 'SEVESTRE', 'first_name' => 'Damien', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2399.76],
            ['last_name' => 'SIDIBE', 'first_name' => 'Drissa', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3033.61],
            ['last_name' => 'SIMOES', 'first_name' => 'Luis', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3543.20],
            ['last_name' => 'TOURE', 'first_name' => 'Abdoulaye', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2425.56],
            ['last_name' => 'TRAORE', 'first_name' => 'Diadie', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 1984.58],
            ['last_name' => 'ULUSAN', 'first_name' => 'Murat', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2536.74],
            ['last_name' => 'UYSAL', 'first_name' => 'Isa', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3379.79],
            ['last_name' => 'UYSAL', 'first_name' => 'Mustafa', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 3274.20],
            ['last_name' => 'ZENGIN', 'first_name' => 'Aytekin', 'status' => 'OUVRIER', 'contract' => '37', 'monthly_salary' => 2855.53],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
