<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['code_id' => 1, 'city' => 'VERSAILLES', 'address' => 'Place d\'armes', 'business' => 'Gardes Suisses', 'kilometers' => 45.3, 'driver' => null],
            ['code_id' => 2, 'city' => 'EP VERSAILLES', 'address' => 'Allée des matelots', 'business' => 'Berges du Grand Canal', 'kilometers' => 45.8, 'driver' => null],
            ['code_id' => 3, 'city' => 'NOTRE DAME DE PARIS', 'address' => 'Rue d\'Accorle', 'business' => 'Cathédrale Notre Dame', 'kilometers' => 43, 'driver' => null],
            ['code_id' => 4, 'city' => 'VITRY S/SEINE', 'address' => 'Place de l\'église', 'business' => 'Eglise St Germain', 'kilometers' => 35.4, 'driver' => null],
            ['code_id' => 5, 'city' => 'VINCENNES', 'address' => 'Avenue de Paris', 'business' => 'Château Vincennes - Pavillon de la reine', 'kilometers' => 46.6, 'driver' => null],
            ['code_id' => 6, 'city' => 'PARIS 9', 'address' => '4 rue Papillon', 'business' => 'Facade Rue Papillon', 'kilometers' => 44.1, 'driver' => null],
            ['code_id' => 7, 'city' => 'LEUVILLE S/ORGE', 'address' => '10 rue Jules Ferry', 'business' => 'Mur Château ministre de Georgie', 'kilometers' => 12.7, 'driver' => null],
            ['code_id' => 8, 'city' => 'FONTAINEBLEAU', 'address' => '-', 'business' => 'Château de Fontainebleau', 'kilometers' => 42.4, 'driver' => null],
            ['code_id' => 9, 'city' => 'VAUX LE VICOMTE', 'address' => '-', 'business' => 'Château de Vaux Le Vicomte', 'kilometers' => 35.6, 'driver' => null],
            ['code_id' => 10, 'city' => 'TOURNAN EN BRIE', 'address' => '1 Place Edmond Rothschild', 'business' => 'Hôtel de ville', 'kilometers' => 46.3, 'driver' => null],
            ['code_id' => 11, 'city' => 'MEUDON', 'address' => '15 rue Porto Riche', 'business' => 'Chapelle ST Georges', 'kilometers' => 41.7, 'driver' => null],
            ['code_id' => 12, 'city' => 'SAINT VRAIN', 'address' => '6 Place de la croix blanch', 'business' => 'EGLISE', 'kilometers' => 1.4, 'driver' => null],
            ['code_id' => 13, 'city' => 'ST MICHEL SUR ORGE', 'address' => '9 rue d\'enfer', 'business' => 'Eglise St Michel', 'kilometers' => 13.7, 'driver' => null],
            ['code_id' => 14, 'city' => 'GRIGNY', 'address' => '13 rue Pierre Brossolette', 'business' => 'Eglise de Grigny', 'kilometers' => 18.3, 'driver' => null],
            ['code_id' => 15, 'city' => 'ORSAY', 'address' => 'Rue de Lozère', 'business' => 'Reconstruction d\'un mur', 'kilometers' => 30.2, 'driver' => null],
            ['code_id' => 16, 'city' => 'BONNELLES', 'address' => 'Rue du clos berger', 'business' => 'Refection mur du presbytère', 'kilometers' => 28.5, 'driver' => null],
            ['code_id' => 17, 'city' => 'PARIS', 'address' => '244 Boulevard Saint Germain', 'business' => 'Ministère de l\'écologie', 'kilometers' => 43.4, 'driver' => null],
            ['code_id' => 18, 'city' => 'PARIS', 'address' => '84 avenue Georges V', 'business' => 'Buste Abraham Lincoln', 'kilometers' => 49, 'driver' => null],
            ['code_id' => 19, 'city' => 'ORSAY', 'address' => '1 rue de la Troche', 'business' => 'Mr Ascoet', 'kilometers' => 30.2, 'driver' => null],
            ['code_id' => 20, 'city' => 'CERNY', 'address' => 'Château de Cerny', 'business' => 'M. Dekerenger', 'kilometers' => 11.2, 'driver' => null],
            ['code_id' => 21, 'city' => 'MONTGERON', 'address' => '130 Avenue Charles de Gaulle', 'business' => 'Eglise', 'kilometers' => 24.9, 'driver' => null],
            ['code_id' => 22, 'city' => 'PARIS', 'address' => '3 Rue du General Clergerie', 'business' => 'Particulier', 'kilometers' => 50, 'driver' => null],
            ['code_id' => 23, 'city' => 'PARIS', 'address' => '4 rueValette', 'business' => 'Bibliothèque Ste Barbe', 'kilometers' => 42.2, 'driver' => null],
            ['code_id' => 24, 'city' => 'GALLUIS', 'address' => '1 rue de la Mairie', 'business' => 'Mairie', 'kilometers' => 57, 'driver' => null],
            ['code_id' => 25, 'city' => 'YERRES', 'address' => '8 rue de Concy', 'business' => 'Maison Caillebotte', 'kilometers' => 32.2, 'driver' => null],
            ['code_id' => 26, 'city' => 'ST MICHEL SUR ORGE', 'address' => '16 rue de l\'Eglise', 'business' => 'Hôtel de ville', 'kilometers' => 15.2, 'driver' => null],
            ['code_id' => 27, 'city' => 'PARIS 11', 'address' => 'Rue de la Folie-Méricourt', 'business' => 'Façades', 'kilometers' => 48.9, 'driver' => null],
            ['code_id' => 28, 'city' => 'LOUVECIENNES', 'address' => '34 rue de Voisins', 'business' => 'Pigeionnier', 'kilometers' => 54, 'driver' => null],
            ['code_id' => 29, 'city' => 'MAROLLES EN HUREPOIX', 'address' => 'Grande rue', 'business' => 'Rénovation du pigeonnier', 'kilometers' => 2.9, 'driver' => null],
            ['code_id' => 30, 'city' => 'MONTGERON', 'address' => '42 rue des saules', 'business' => 'Maison de retraite', 'kilometers' => 25.1, 'driver' => null],
            ['code_id' => 31, 'city' => 'PARIS', 'address' => 'Face au 14 rue de Bourgogne / 32 rue Las Cases', 'business' => 'Assemblée Nationale - hotel de BROGLIE', 'kilometers' => 45.1, 'driver' => null],
            ['code_id' => 32, 'city' => 'EVRY', 'address' => '8 rue Georges Brassens', 'business' => 'Lycée G Brassens', 'kilometers' => 15.9, 'driver' => null],
            ['code_id' => 33, 'city' => 'PARIS 6EME', 'address' => '60 boulevard St Michel', 'business' => 'Ecole des Mines', 'kilometers' => 43.2, 'driver' => null],
            ['code_id' => 34, 'city' => 'DRAVEIL', 'address' => '6b BD Henri Barbusse / 2 Rue de Villiers', 'business' => 'conservatoire de musique', 'kilometers' => 21.3, 'driver' => null],
            ['code_id' => 35, 'city' => 'MARCOUSSIS', 'address' => '44 rue Alfred Dubois', 'business' => '18 logements', 'kilometers' => 18.4, 'driver' => null],
            ['code_id' => 36, 'city' => 'OLLAINVILLE', 'address' => 'rue de la république', 'business' => 'Logements', 'kilometers' => 11.7, 'driver' => null],
            ['code_id' => 37, 'city' => 'ETAMPES', 'address' => 'Avenue Charles de Gaulle', 'business' => 'Restaurant Base de Loisirs', 'kilometers' => 21.8, 'driver' => null],
            ['code_id' => 38, 'city' => 'PARIS', 'address' => '129 rue de Grenelle', 'business' => 'Musée de l\'armée - Porche des Invalides', 'kilometers' => 44.9, 'driver' => null],
            ['code_id' => 39, 'city' => 'MAROLLES EN HUREPOIX', 'address' => '11 Grande Rue', 'business' => '11 Logements', 'kilometers' => 2.9, 'driver' => null],
            ['code_id' => 40, 'city' => 'MONTIGNY-LE-BRETONNEUX', 'address' => '1 rue Stephenson', 'business' => 'Le Stephenson', 'kilometers' => 45.9, 'driver' => null],
            ['code_id' => 41, 'city' => 'L\'HAY LES ROSES', 'address' => '22 rue des jardins', 'business' => 'SCI AERTOIT', 'kilometers' => 34.7, 'driver' => null],
            ['code_id' => 42, 'city' => 'LARDY', 'address' => 'Route Nationale', 'business' => 'Ancienne halle SNCF', 'kilometers' => 3.6, 'driver' => null],
            ['code_id' => 43, 'city' => 'MARCOUSSIS', 'address' => '53 Chemin de la Ronce', 'business' => '3 F', 'kilometers' => 21.7, 'driver' => null],
            ['code_id' => 44, 'city' => 'MOIGNY SUR ECOLE', 'address' => '1 Rue Marie Louise Fuga', 'business' => 'Coursive de Moigny', 'kilometers' => 22.6, 'driver' => null],
            ['code_id' => 45, 'city' => 'LARDY', 'address' => '1 Allée Cornuel', 'business' => 'Renault SAS', 'kilometers' => 5, 'driver' => null],
            ['code_id' => 46, 'city' => 'VIRY CHATILLON', 'address' => '1-15 Avenue du Président Kennedy', 'business' => 'Renault F1 (Alpline)', 'kilometers' => 17.7, 'driver' => null],
            ['code_id' => 47, 'city' => 'MONTLHERY', 'address' => 'Rue de Longpont', 'business' => 'Eneria', 'kilometers' => 15.4, 'driver' => null],
            ['code_id' => 48, 'city' => 'DOURDAN', 'address' => '-', 'business' => 'Hôtel dieu', 'kilometers' => 0, 'driver' => null],
            ['code_id' => 49, 'city' => 'GRIGNY', 'address' => '-', 'business' => 'Grange/Salle conseil municipal', 'kilometers' => 0, 'driver' => null],
            ['code_id' => 50, 'city' => 'SAINT CLOUD', 'address' => '8 Rue Emile Verhaeren', 'business' => 'Ecole Saint Joseph', 'kilometers' => 49.6, 'driver' => null],
            ['code_id' => 51, 'city' => 'ST MICHEL SUR ORGE', 'address' => 'Rue de la Mare des Bordes', 'business' => 'Ecole Jules Verne', 'kilometers' => 14.1, 'driver' => null],
            ['code_id' => 52, 'city' => 'GIGNY', 'address' => '14 Avenue des Tuilleries', 'business' => 'Ecole Paul Langevin', 'kilometers' => 18, 'driver' => null],
            ['code_id' => 53, 'city' => 'LARDY', 'address' => '1 Allée Cornuel', 'business' => 'Serma - Renault', 'kilometers' => 5, 'driver' => null],
            ['code_id' => 54, 'city' => 'LEUDEVILLE', 'address' => '60 rue de la Croix Boissée', 'business' => 'Ferme de Leudeville', 'kilometers' => 3.9, 'driver' => null],
            ['code_id' => 55, 'city' => 'FONTENAY AUX ROSES', 'address' => 'Route du Panorama', 'business' => 'CEA', 'kilometers' => 36.1, 'driver' => null],
        ];

        DB::table('projects')->insert($projects);
    }
}
