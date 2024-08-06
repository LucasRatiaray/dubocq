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
            ['codeId' => 1, 'city' => 'VERSAILLES', 'address' => 'Place d\'armes', 'business' => 'Gardes Suisses', 'km' => 45.3, 'driver' => null],
            ['codeId' => 2, 'city' => 'EP VERSAILLES', 'address' => 'Allée des matelots', 'business' => 'Berges du Grand Canal', 'km' => 45.8, 'driver' => null],
            ['codeId' => 3, 'city' => 'NOTRE DAME DE PARIS', 'address' => 'Rue d\'Accorle', 'business' => 'Cathédrale Notre Dame', 'km' => 43, 'driver' => null],
            ['codeId' => 4, 'city' => 'VITRY S/SEINE', 'address' => 'Place de l\'église', 'business' => 'Eglise St Germain', 'km' => 35.4, 'driver' => null],
            ['codeId' => 5, 'city' => 'VINCENNES', 'address' => 'Avenue de Paris', 'business' => 'Château Vincennes - Pavillon de la reine', 'km' => 46.6, 'driver' => null],
            ['codeId' => 6, 'city' => 'PARIS 9', 'address' => '4 rue Papillon', 'business' => 'Facade Rue Papillon', 'km' => 44.1, 'driver' => null],
            ['codeId' => 7, 'city' => 'LEUVILLE S/ORGE', 'address' => '10 rue Jules Ferry', 'business' => 'Mur Château ministre de Georgie', 'km' => 12.7, 'driver' => null],
            ['codeId' => 8, 'city' => 'FONTAINEBLEAU', 'address' => '-', 'business' => 'Château de Fontainebleau', 'km' => 42.4, 'driver' => null],
            ['codeId' => 9, 'city' => 'VAUX LE VICOMTE', 'address' => '-', 'business' => 'Château de Vaux Le Vicomte', 'km' => 35.6, 'driver' => null],
            ['codeId' => 10, 'city' => 'TOURNAN EN BRIE', 'address' => '1 Place Edmond Rothschild', 'business' => 'Hôtel de ville', 'km' => 46.3, 'driver' => null],
            ['codeId' => 11, 'city' => 'MEUDON', 'address' => '15 rue Porto Riche', 'business' => 'Chapelle ST Georges', 'km' => 41.7, 'driver' => null],
            ['codeId' => 12, 'city' => 'SAINT VRAIN', 'address' => '6 Place de la croix blanch', 'business' => 'EGLISE', 'km' => 1.4, 'driver' => null],
            ['codeId' => 13, 'city' => 'ST MICHEL SUR ORGE', 'address' => '9 rue d\'enfer', 'business' => 'Eglise St Michel', 'km' => 13.7, 'driver' => null],
            ['codeId' => 14, 'city' => 'GRIGNY', 'address' => '13 rue Pierre Brossolette', 'business' => 'Eglise de Grigny', 'km' => 18.3, 'driver' => null],
            ['codeId' => 15, 'city' => 'ORSAY', 'address' => 'Rue de Lozère', 'business' => 'Reconstruction d\'un mur', 'km' => 30.2, 'driver' => null],
            ['codeId' => 16, 'city' => 'BONNELLES', 'address' => 'Rue du clos berger', 'business' => 'Refection mur du presbytère', 'km' => 28.5, 'driver' => null],
            ['codeId' => 17, 'city' => 'PARIS', 'address' => '244 Boulevard Saint Germain', 'business' => 'Ministère de l\'écologie', 'km' => 43.4, 'driver' => null],
            ['codeId' => 18, 'city' => 'PARIS', 'address' => '84 avenue Georges V', 'business' => 'Buste Abraham Lincoln', 'km' => 49, 'driver' => null],
            ['codeId' => 19, 'city' => 'ORSAY', 'address' => '1 rue de la Troche', 'business' => 'Mr Ascoet', 'km' => 30.2, 'driver' => null],
            ['codeId' => 20, 'city' => 'CERNY', 'address' => 'Château de Cerny', 'business' => 'M. Dekerenger', 'km' => 11.2, 'driver' => null],
            ['codeId' => 21, 'city' => 'MONTGERON', 'address' => '130 Avenue Charles de Gaulle', 'business' => 'Eglise', 'km' => 24.9, 'driver' => null],
            ['codeId' => 22, 'city' => 'PARIS', 'address' => '3 Rue du General Clergerie', 'business' => 'Particulier', 'km' => 50, 'driver' => null],
            ['codeId' => 23, 'city' => 'PARIS', 'address' => '4 rueValette', 'business' => 'Bibliothèque Ste Barbe', 'km' => 42.2, 'driver' => null],
            ['codeId' => 24, 'city' => 'GALLUIS', 'address' => '1 rue de la Mairie', 'business' => 'Mairie', 'km' => 57, 'driver' => null],
            ['codeId' => 25, 'city' => 'YERRES', 'address' => '8 rue de Concy', 'business' => 'Maison Caillebotte', 'km' => 32.2, 'driver' => null],
            ['codeId' => 26, 'city' => 'ST MICHEL SUR ORGE', 'address' => '16 rue de l\'Eglise', 'business' => 'Hôtel de ville', 'km' => 15.2, 'driver' => null],
            ['codeId' => 27, 'city' => 'PARIS 11', 'address' => 'Rue de la Folie-Méricourt', 'business' => 'Façades', 'km' => 48.9, 'driver' => null],
            ['codeId' => 28, 'city' => 'LOUVECIENNES', 'address' => '34 rue de Voisins', 'business' => 'Pigeionnier', 'km' => 54, 'driver' => null],
            ['codeId' => 29, 'city' => 'MAROLLES EN HUREPOIX', 'address' => 'Grande rue', 'business' => 'Rénovation du pigeonnier', 'km' => 2.9, 'driver' => null],
            ['codeId' => 30, 'city' => 'MONTGERON', 'address' => '42 rue des saules', 'business' => 'Maison de retraite', 'km' => 25.1, 'driver' => null],
            ['codeId' => 31, 'city' => 'PARIS', 'address' => 'Face au 14 rue de Bourgogne / 32 rue Las Cases', 'business' => 'Assemblée Nationale - hotel de BROGLIE', 'km' => 45.1, 'driver' => null],
            ['codeId' => 32, 'city' => 'EVRY', 'address' => '8 rue Georges Brassens', 'business' => 'Lycée G Brassens', 'km' => 15.9, 'driver' => null],
            ['codeId' => 33, 'city' => 'PARIS 6EME', 'address' => '60 boulevard St Michel', 'business' => 'Ecole des Mines', 'km' => 43.2, 'driver' => null],
            ['codeId' => 34, 'city' => 'DRAVEIL', 'address' => '6b BD Henri Barbusse / 2 Rue de Villiers', 'business' => 'conservatoire de musique', 'km' => 21.3, 'driver' => null],
            ['codeId' => 35, 'city' => 'MARCOUSSIS', 'address' => '44 rue Alfred Dubois', 'business' => '18 logements', 'km' => 18.4, 'driver' => null],
            ['codeId' => 36, 'city' => 'OLLAINVILLE', 'address' => 'rue de la république', 'business' => 'Logements', 'km' => 11.7, 'driver' => null],
            ['codeId' => 37, 'city' => 'ETAMPES', 'address' => 'Avenue Charles de Gaulle', 'business' => 'Restaurant Base de Loisirs', 'km' => 21.8, 'driver' => null],
            ['codeId' => 38, 'city' => 'PARIS', 'address' => '129 rue de Grenelle', 'business' => 'Musée de l\'armée - Porche des Invalides', 'km' => 44.9, 'driver' => null],
            ['codeId' => 39, 'city' => 'MAROLLES EN HUREPOIX', 'address' => '11 Grande Rue', 'business' => '11 Logements', 'km' => 2.9, 'driver' => null],
            ['codeId' => 40, 'city' => 'MONTIGNY-LE-BRETONNEUX', 'address' => '1 rue Stephenson', 'business' => 'Le Stephenson', 'km' => 45.9, 'driver' => null],
            ['codeId' => 41, 'city' => 'L\'HAY LES ROSES', 'address' => '22 rue des jardins', 'business' => 'SCI AERTOIT', 'km' => 34.7, 'driver' => null],
            ['codeId' => 42, 'city' => 'LARDY', 'address' => 'Route Nationale', 'business' => 'Ancienne halle SNCF', 'km' => 3.6, 'driver' => null],
            ['codeId' => 43, 'city' => 'MARCOUSSIS', 'address' => '53 Chemin de la Ronce', 'business' => '3 F', 'km' => 21.7, 'driver' => null],
            ['codeId' => 44, 'city' => 'MOIGNY SUR ECOLE', 'address' => '1 Rue Marie Louise Fuga', 'business' => 'Coursive de Moigny', 'km' => 22.6, 'driver' => null],
            ['codeId' => 45, 'city' => 'LARDY', 'address' => '1 Allée Cornuel', 'business' => 'Renault SAS', 'km' => 5, 'driver' => null],
            ['codeId' => 46, 'city' => 'VIRY CHATILLON', 'address' => '1-15 Avenue du Président Kennedy', 'business' => 'Renault F1 (Alpline)', 'km' => 17.7, 'driver' => null],
            ['codeId' => 47, 'city' => 'MONTLHERY', 'address' => 'Rue de Longpont', 'business' => 'Eneria', 'km' => 15.4, 'driver' => null],
            ['codeId' => 48, 'city' => 'DOURDAN', 'address' => '-', 'business' => 'Hôtel dieu', 'km' => 0, 'driver' => null],
            ['codeId' => 49, 'city' => 'GRIGNY', 'address' => '-', 'business' => 'Grange/Salle conseil municipal', 'km' => 0, 'driver' => null],
            ['codeId' => 50, 'city' => 'SAINT CLOUD', 'address' => '8 Rue Emile Verhaeren', 'business' => 'Ecole Saint Joseph', 'km' => 49.6, 'driver' => null],
            ['codeId' => 51, 'city' => 'ST MICHEL SUR ORGE', 'address' => 'Rue de la Mare des Bordes', 'business' => 'Ecole Jules Verne', 'km' => 14.1, 'driver' => null],
            ['codeId' => 52, 'city' => 'GIGNY', 'address' => '14 Avenue des Tuilleries', 'business' => 'Ecole Paul Langevin', 'km' => 18, 'driver' => null],
            ['codeId' => 53, 'city' => 'LARDY', 'address' => '1 Allée Cornuel', 'business' => 'Serma - Renault', 'km' => 5, 'driver' => null],
            ['codeId' => 54, 'city' => 'LEUDEVILLE', 'address' => '60 rue de la Croix Boissée', 'business' => 'Ferme de Leudeville', 'km' => 3.9, 'driver' => null],
            ['codeId' => 55, 'city' => 'FONTENAY AUX ROSES', 'address' => 'Route du Panorama', 'business' => 'CEA', 'km' => 36.1, 'driver' => null],
        ];

        DB::table('projects')->insert($projects);
    }
}
