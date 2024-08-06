<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['lastName' => 'ANTUNES', 'firstName' => 'Alvin', 'status' => 'OUVRIER'],
            ['lastName' => 'AYEB', 'firstName' => 'Mounir', 'status' => 'OUVRIER'],
            ['lastName' => 'BARRETO', 'firstName' => 'Alcindo', 'status' => 'OUVRIER'],
            ['lastName' => 'BEITO AMORIN', 'firstName' => 'Rui', 'status' => 'OUVRIER'],
            ['lastName' => 'BOUTONNET', 'firstName' => 'Lucas', 'status' => 'OUVRIER'],
            ['lastName' => 'CABRAL ROBALO', 'firstName' => 'Gilson', 'status' => 'OUVRIER'],
            ['lastName' => 'CARVALHO', 'firstName' => 'Jorge', 'status' => 'OUVRIER'],
            ['lastName' => 'CINGOZ', 'firstName' => 'Ahmet', 'status' => 'OUVRIER'],
            ['lastName' => 'COCHAN', 'firstName' => 'Julien', 'status' => 'OUVRIER'],
            ['lastName' => 'COLLINS', 'firstName' => 'Steeve', 'status' => 'OUVRIER'],
            ['lastName' => 'COULIBALY', 'firstName' => 'Faguimba', 'status' => 'OUVRIER'],
            ['lastName' => 'COULIBALY', 'firstName' => 'Lamourou', 'status' => 'OUVRIER'],
            ['lastName' => 'COUVEUR', 'firstName' => 'Dominique', 'status' => 'OUVRIER'],
            ['lastName' => 'DA MOURA', 'firstName' => 'Chirstophe', 'status' => 'OUVRIER'],
            ['lastName' => 'DA SILVA', 'firstName' => 'Noberto', 'status' => 'OUVRIER'],
            ['lastName' => 'DA SILVA CAMPOS', 'firstName' => 'José', 'status' => 'OUVRIER'],
            ['lastName' => 'DA SILVA SANTOS', 'firstName' => 'Joaquim', 'status' => 'OUVRIER'],
            ['lastName' => 'DA SILVA VAZ', 'firstName' => 'Paulo Jorge', 'status' => 'OUVRIER'],
            ['lastName' => 'DE LIMA FERNANDES', 'firstName' => 'Manuel', 'status' => 'OUVRIER'],
            ['lastName' => 'DE OLIVEIRA MANCO', 'firstName' => 'Rui', 'status' => 'OUVRIER'],
            ['lastName' => 'DE PINA DIAS', 'firstName' => 'Angelo', 'status' => 'OUVRIER'],
            ['lastName' => 'DELAVAUD', 'firstName' => 'Jean Baptiste', 'status' => 'OUVRIER'],
            ['lastName' => 'DEMBELE', 'firstName' => 'Diakou', 'status' => 'OUVRIER'],
            ['lastName' => 'DEMIGNY', 'firstName' => 'Fabien', 'status' => 'OUVRIER'],
            ['lastName' => 'DIARRA', 'firstName' => 'Mama', 'status' => 'OUVRIER'],
            ['lastName' => 'DOS SANTOS', 'firstName' => 'elias', 'status' => 'OUVRIER'],
            ['lastName' => 'DUARTE DA MOURA', 'firstName' => 'Alvarino', 'status' => 'OUVRIER'],
            ['lastName' => 'ESNAULT', 'firstName' => 'Nicolas', 'status' => 'OUVRIER'],
            ['lastName' => 'FERNANDES', 'firstName' => 'Ludovic', 'status' => 'OUVRIER'],
            ['lastName' => 'FERNANDES', 'firstName' => 'Christophe', 'status' => 'ETAM'],
            ['lastName' => 'FERNANDES', 'firstName' => 'Antonio', 'status' => 'OUVRIER'],
            ['lastName' => 'FLORA ALVES', 'firstName' => 'Joao', 'status' => 'OUVRIER'],
            ['lastName' => 'GERMOND', 'firstName' => 'christophe', 'status' => 'OUVRIER'],
            ['lastName' => 'GOMES', 'firstName' => 'Domingos', 'status' => 'ETAM'],
            ['lastName' => 'GOMES PACHECO', 'firstName' => 'José Manuel', 'status' => 'OUVRIER'],
            ['lastName' => 'GONCALVES', 'firstName' => 'Jorge', 'status' => 'OUVRIER'],
            ['lastName' => 'GOURDON', 'firstName' => 'Guillaume', 'status' => 'OUVRIER'],
            ['lastName' => 'KAPUSUK', 'firstName' => 'Férit', 'status' => 'OUVRIER'],
            ['lastName' => 'LOPES', 'firstName' => 'Sergio', 'status' => 'OUVRIER'],
            ['lastName' => 'LOURENCO', 'firstName' => 'Paulo', 'status' => 'OUVRIER'],
            ['lastName' => 'MAGASSA', 'firstName' => 'Cheikhou', 'status' => 'OUVRIER'],
            ['lastName' => 'MALHEIRO', 'firstName' => 'Carlos', 'status' => 'ETAM'],
            ['lastName' => 'MARASLIOGLU', 'firstName' => 'Tacettin', 'status' => 'OUVRIER'],
            ['lastName' => 'MARTINEZ', 'firstName' => 'Cyril', 'status' => 'OUVRIER'],
            ['lastName' => 'MENDES DE BRITO', 'firstName' => 'Joao', 'status' => 'OUVRIER'],
            ['lastName' => 'MICHAUT', 'firstName' => 'Stéphane', 'status' => 'OUVRIER'],
            ['lastName' => 'NOEL', 'firstName' => 'Théo', 'status' => 'OUVRIER'],
            ['lastName' => 'OUERFELLI', 'firstName' => 'Rayyan', 'status' => 'OUVRIER'],
            ['lastName' => 'OZDAMAR', 'firstName' => 'Ahmet', 'status' => 'OUVRIER'],
            ['lastName' => 'PASSEIRA', 'firstName' => 'Joao', 'status' => 'OUVRIER'],
            ['lastName' => 'PINTO DA SILVA', 'firstName' => 'Antonino', 'status' => 'OUVRIER'],
            ['lastName' => 'POUPRY', 'firstName' => 'Alexandre', 'status' => 'OUVRIER'],
            ['lastName' => 'RODRIGUES', 'firstName' => 'David', 'status' => 'ETAM'],
            ['lastName' => 'RODRIGUES', 'firstName' => 'Noé', 'status' => 'ETAM'],
            ['lastName' => 'SEMEDO MOREIRA', 'firstName' => 'Eusébio', 'status' => 'OUVRIER'],
            ['lastName' => 'SEMEDO CABRAL', 'firstName' => 'Félisberto', 'status' => 'OUVRIER'],
            ['lastName' => 'SEVESTRE', 'firstName' => 'Damien', 'status' => 'OUVRIER'],
            ['lastName' => 'SIDIBE', 'firstName' => 'Drissa', 'status' => 'OUVRIER'],
            ['lastName' => 'SIMOES', 'firstName' => 'Luis', 'status' => 'OUVRIER'],
            ['lastName' => 'STINGA', 'firstName' => 'Zamfir', 'status' => 'OUVRIER'],
            ['lastName' => 'TOURE', 'firstName' => 'Abdoulaye', 'status' => 'OUVRIER'],
            ['lastName' => 'TRAORE', 'firstName' => 'Diadie', 'status' => 'OUVRIER'],
            ['lastName' => 'ULUSAN', 'firstName' => 'Murat', 'status' => 'OUVRIER'],
            ['lastName' => 'UYSAL', 'firstName' => 'Isa', 'status' => 'OUVRIER'],
            ['lastName' => 'UYSAL', 'firstName' => 'Mustafa', 'status' => 'OUVRIER'],
            ['lastName' => 'ZENGIN', 'firstName' => 'Aytekin', 'status' => 'OUVRIER']
        ];

        DB::table('employees')->insert($employees);
    }
}
