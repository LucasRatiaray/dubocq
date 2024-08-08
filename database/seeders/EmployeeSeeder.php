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
            ['last_name' => 'AYEB', 'first_name' => 'Mounir', 'hourly_rate' => 17.54133056, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'BARRETO', 'first_name' => 'Alcindo', 'hourly_rate' => 23.91698545, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'BEITO AMORIN', 'first_name' => 'Rui', 'hourly_rate' => 15.49035343, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'BOUTONNET', 'first_name' => 'Lucas', 'hourly_rate' => 4.608030593, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'CABRAL ROBALO', 'first_name' => 'Gilson', 'hourly_rate' => 19.60540541, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'CARVALHO', 'first_name' => 'Jorge', 'hourly_rate' => 18.81804574, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'CINGOZ', 'first_name' => 'Ahmet', 'hourly_rate' => 16.44049896, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'COCHAN', 'first_name' => 'Julien', 'hourly_rate' => 21.13372141, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'COLLINS', 'first_name' => 'Steeve', 'hourly_rate' => 17.54569647, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'COULIBALY', 'first_name' => 'Faguimba', 'hourly_rate' => 15.07097713, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'COULIBALY', 'first_name' => 'Lamourou', 'hourly_rate' => 15.52309771, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'COUVEUR', 'first_name' => 'Dominique', 'hourly_rate' => 18.81804574, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DA MOURA', 'first_name' => 'Chirstophe', 'hourly_rate' => 12.26575884, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DA SILVA', 'first_name' => 'Noberto', 'hourly_rate' => 24.65744283, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DA SILVA CAMPOS', 'first_name' => 'José', 'hourly_rate' => 20.75538462, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DA SILVA SANTOS', 'first_name' => 'Joaquim', 'hourly_rate' => 16.42733888, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DA SILVA VAZ', 'first_name' => 'Paulo Jorge', 'hourly_rate' => 16.91931393, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DE LIMA FERNANDES', 'first_name' => 'Manuel', 'hourly_rate' => 22.96029106, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DE OLIVEIRA MANCO', 'first_name' => 'Rui', 'hourly_rate' => 22.54091476, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DE PINA DIAS', 'first_name' => 'Angelo', 'hourly_rate' => 18.76665281, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DELAVAUD', 'first_name' => 'Jean Baptiste', 'hourly_rate' => 18.39243243, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DEMBELE', 'first_name' => 'Diakou', 'hourly_rate' => 12.26575884, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DIARRA', 'first_name' => 'Mama', 'hourly_rate' => 12.26575884, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DOS SANTOS', 'first_name' => 'Elias', 'hourly_rate' => 18.6208316, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'DUARTE DA MOURA', 'first_name' => 'Alvarino', 'hourly_rate' => 19.47193347, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'ESNAULT', 'first_name' => 'Nicolas', 'hourly_rate' => 19.37151767, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'FERNANDES', 'first_name' => 'Ludovic', 'hourly_rate' => 21.43035343, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'FERNANDES', 'first_name' => 'Christophe', 'hourly_rate' => 26.4135343, 'status' => 'ETAM', 'contract' => '37H'],
            ['last_name' => 'FERNANDES', 'first_name' => 'Antonio', 'hourly_rate' => 27.14089397, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'FLORA ALVES', 'first_name' => 'Joao', 'hourly_rate' => 23.32072765, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'GERMOND', 'first_name' => 'Christophe', 'hourly_rate' => 20.92247401, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'GOMES', 'first_name' => 'Domingos', 'hourly_rate' => 35.79686071, 'status' => 'ETAM', 'contract' => '37H'],
            ['last_name' => 'GOMES PACHECO', 'first_name' => 'José Manuel', 'hourly_rate' => 21.87904366, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'GONCALVES', 'first_name' => 'Jorge', 'hourly_rate' => 21.60449064, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'GOURDON', 'first_name' => 'Guillaume', 'hourly_rate' => 21.69567568, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'KAPUSUK', 'first_name' => 'Férit', 'hourly_rate' => 17.46923077, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'LOPES', 'first_name' => 'Sergio', 'hourly_rate' => 14.63201663, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'LOURENCO', 'first_name' => 'Paulo', 'hourly_rate' => 17.94898129, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'MAGASSA', 'first_name' => 'Cheikhou', 'hourly_rate' => 15.07097713, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'MALHEIRO', 'first_name' => 'Carlos', 'hourly_rate' => 23.49480249, 'status' => 'ETAM', 'contract' => '37H'],
            ['last_name' => 'MARASLIOGLU', 'first_name' => 'Tacettin', 'hourly_rate' => 21.02045738, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'MARTINEZ', 'first_name' => 'Cyril', 'hourly_rate' => 19.08523909, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'MENDES DE BRITO', 'first_name' => 'Joao', 'hourly_rate' => 16.74012474, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'MICHAUT', 'first_name' => 'Stéphane', 'hourly_rate' => 15.28952183, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'NOEL', 'first_name' => 'Théo', 'hourly_rate' => 9.215995253, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'OUERFELLI', 'first_name' => 'Rayyan', 'hourly_rate' => 5.838087318, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'OZDAMAR', 'first_name' => 'Ahmet', 'hourly_rate' => 16.81496881, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'PASSEIRA', 'first_name' => 'Joao', 'hourly_rate' => 19.88045738, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'PINTO DA SILVA', 'first_name' => 'Antonino', 'hourly_rate' => 20.70954262, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'POUPRY', 'first_name' => 'Alexandre', 'hourly_rate' => 18.72324324, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'RODRIGUES', 'first_name' => 'David', 'hourly_rate' => 23.93912682, 'status' => 'ETAM', 'contract' => '37H'],
            ['last_name' => 'RODRIGUES', 'first_name' => 'Noé', 'hourly_rate' => 23.93912682, 'status' => 'ETAM', 'contract' => '37H'],
            ['last_name' => 'SEMEDO MOREIRA', 'first_name' => 'Eusébio', 'hourly_rate' => 14.37037422, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'SEMEDO CABRAL', 'first_name' => 'Félisberto', 'hourly_rate' => 19.5966736, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'SEVESTRE', 'first_name' => 'Damien', 'hourly_rate' => 14.96731809, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'SIDIBE', 'first_name' => 'Drissa', 'hourly_rate' => 18.92064449, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'SIMOES', 'first_name' => 'Luis', 'hourly_rate' => 22.0989605, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'TOURE', 'first_name' => 'Abdoulaye', 'hourly_rate' => 15.12823285, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'TRAORE', 'first_name' => 'Diadie', 'hourly_rate' => 12.37783784, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'ULUSAN', 'first_name' => 'Murat', 'hourly_rate' => 15.8216632, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'UYSAL', 'first_name' => 'Isa', 'hourly_rate' => 21.07977131, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'UYSAL', 'first_name' => 'Mustafa', 'hourly_rate' => 20.42120582, 'status' => 'OUVRIER', 'contract' => '37H'],
            ['last_name' => 'ZENGIN', 'first_name' => 'Aytekin', 'hourly_rate' => 17.80995842, 'status' => 'OUVRIER', 'contract' => '37H'],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
