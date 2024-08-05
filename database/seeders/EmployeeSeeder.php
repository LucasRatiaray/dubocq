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
        DB::table('employees')->insert([
            ['lastName' => 'ANTUNES', 'firstName' => 'Alvin', 'description' => null],
            ['lastName' => 'AYEB', 'firstName' => 'Mounir', 'description' => null],
            ['lastName' => 'BARRETO', 'firstName' => 'Alcindo', 'description' => null],
            ['lastName' => 'BEITO AMORIN', 'firstName' => 'Rui', 'description' => null],
            ['lastName' => 'BOUTONNET', 'firstName' => 'Lucas', 'description' => null],
            ['lastName' => 'CABRAL ROBALO', 'firstName' => 'Gilson', 'description' => null],
            ['lastName' => 'CARVALHO', 'firstName' => 'Jorge', 'description' => null],
            ['lastName' => 'CINGOZ', 'firstName' => 'Ahmet', 'description' => null],
            ['lastName' => 'COCHAN', 'firstName' => 'Julien', 'description' => null],
            ['lastName' => 'COLLINS', 'firstName' => 'Steeve', 'description' => null],
            ['lastName' => 'COULIBALY', 'firstName' => 'Faguimba', 'description' => null],
            ['lastName' => 'COULIBALY', 'firstName' => 'Lamourou', 'description' => null],
            ['lastName' => 'COUVEUR', 'firstName' => 'Dominique', 'description' => null],
            ['lastName' => 'DA MOURA', 'firstName' => 'Chirstophe', 'description' => null],
            ['lastName' => 'DA SILVA', 'firstName' => 'Noberto', 'description' => null],
            ['lastName' => 'DA SILVA CAMPOS', 'firstName' => 'José', 'description' => null],
            ['lastName' => 'DA SILVA SANTOS', 'firstName' => 'Joaquim', 'description' => null],
            ['lastName' => 'DA SILVA VAZ', 'firstName' => 'Paulo Jorge', 'description' => null],
            ['lastName' => 'DE LIMA FERNANDES', 'firstName' => 'Manuel', 'description' => null],
            ['lastName' => 'DE OLIVEIRA MANCO', 'firstName' => 'Rui', 'description' => null],
            ['lastName' => 'DE PINA DIAS', 'firstName' => 'Angelo', 'description' => null],
            ['lastName' => 'DELAVAUD', 'firstName' => 'Jean Baptiste', 'description' => null],
            ['lastName' => 'DEMBELE', 'firstName' => 'Diakou', 'description' => null],
            ['lastName' => 'DEMIGNY', 'firstName' => 'Fabien', 'description' => null],
            ['lastName' => 'DIARRA', 'firstName' => 'Mama', 'description' => null],
            ['lastName' => 'DOS SANTOS', 'firstName' => 'elias', 'description' => null],
            ['lastName' => 'DUARTE DA MOURA', 'firstName' => 'Alvarino', 'description' => null],
            ['lastName' => 'ESNAULT', 'firstName' => 'Nicolas', 'description' => null],
            ['lastName' => 'FERNANDES', 'firstName' => 'Ludovic', 'description' => null],
            ['lastName' => 'FERNANDES', 'firstName' => 'Christophe', 'description' => null],
            ['lastName' => 'FERNANDES', 'firstName' => 'Antonio', 'description' => null],
            ['lastName' => 'FLORA ALVES', 'firstName' => 'Joao', 'description' => null],
            ['lastName' => 'GERMOND', 'firstName' => 'christophe', 'description' => null],
            ['lastName' => 'GOMES', 'firstName' => 'Domingos', 'description' => null],
            ['lastName' => 'GOMES PACHECO', 'firstName' => 'José Manuel', 'description' => null],
            ['lastName' => 'GONCALVES', 'firstName' => 'Jorge', 'description' => null],
            ['lastName' => 'GOURDON', 'firstName' => 'Guillaume', 'description' => null],
            ['lastName' => 'KAPUSUK', 'firstName' => 'Férit', 'description' => null],
            ['lastName' => 'LOPES', 'firstName' => 'Sergio', 'description' => null],
            ['lastName' => 'LOURENCO', 'firstName' => 'Paulo', 'description' => null],
            ['lastName' => 'MAGASSA', 'firstName' => 'Cheikhou', 'description' => null],
            ['lastName' => 'MALHEIRO', 'firstName' => 'Carlos', 'description' => null],
            ['lastName' => 'MARASLIOGLU', 'firstName' => 'Tacettin', 'description' => null],
            ['lastName' => 'MARTINEZ', 'firstName' => 'Cyril', 'description' => null],
            ['lastName' => 'MENDES DE BRITO', 'firstName' => 'Joao', 'description' => null],
            ['lastName' => 'MICHAUT', 'firstName' => 'Stéphane', 'description' => null],
            ['lastName' => 'NOEL', 'firstName' => 'Théo', 'description' => null],
            ['lastName' => 'OUERFELLI', 'firstName' => 'Rayyan', 'description' => null],
            ['lastName' => 'OZDAMAR', 'firstName' => 'Ahmet', 'description' => null],
            ['lastName' => 'PASSEIRA', 'firstName' => 'Joao', 'description' => null],
            ['lastName' => 'PINTO DA SILVA', 'firstName' => 'Antonino', 'description' => null],
            ['lastName' => 'POUPRY', 'firstName' => 'Alexandre', 'description' => null],
            ['lastName' => 'RODRIGUES', 'firstName' => 'David', 'description' => null],
            ['lastName' => 'RODRIGUES', 'firstName' => 'Noé', 'description' => null],
            ['lastName' => 'SEMEDO MOREIRA', 'firstName' => 'Eusébio', 'description' => null],
            ['lastName' => 'SEMEDO CABRAL', 'firstName' => 'Félisberto', 'description' => null],
            ['lastName' => 'SEVESTRE', 'firstName' => 'Damien', 'description' => null],
            ['lastName' => 'SIDIBE', 'firstName' => 'Drissa', 'description' => null],
            ['lastName' => 'SIMOES', 'firstName' => 'Luis', 'description' => null],
            ['lastName' => 'STINGA', 'firstName' => 'Zamfir', 'description' => null],
            ['lastName' => 'TOURE', 'firstName' => 'Abdoulaye', 'description' => null],
            ['lastName' => 'TRAORE', 'firstName' => 'Diadie', 'description' => null],
            ['lastName' => 'ULUSAN', 'firstName' => 'Murat', 'description' => null],
            ['lastName' => 'UYSAL', 'firstName' => 'Isa', 'description' => null],
            ['lastName' => 'UYSAL', 'firstName' => 'Mustafa', 'description' => null],
            ['lastName' => 'ZENGIN', 'firstName' => 'Aytekin', 'description' => null],
        ]);
    }
}
