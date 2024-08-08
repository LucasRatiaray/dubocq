<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['code' => '119018', 'city' => 'VERSAILLES', 'address' => "Place d'armes", 'business' => 'Gardes Suisses', 'kilometers' => 45.3],
            ['code' => '121004', 'city' => 'EP VERSAILLES', 'address' => 'Allée des matelots', 'business' => 'Berges du Grand Canal', 'kilometers' => 45.8],
            ['code' => '122006', 'city' => 'NOTRE DAME DE PARIS', 'address' => "Rue d'Accorle", 'business' => 'Cathédrale Notre Dame', 'kilometers' => 43],
            ['code' => '122011', 'city' => 'VITRY S/SEINE', 'address' => "Place de l'église", 'business' => 'Eglise St Germain', 'kilometers' => 35.4],
            ['code' => '122013', 'city' => 'VINCENNES', 'address' => 'Avenue de Paris', 'business' => 'Château Vincennes - Pavillon de la reine', 'kilometers' => 46.6],
            ['code' => '123002', 'city' => 'PARIS 9', 'address' => '4 rue Papillon', 'business' => 'Facade Rue Papillon', 'kilometers' => 44.1],
            ['code' => '123008', 'city' => 'LEUVILLE S/ORGE', 'address' => '10 rue Jules Ferry', 'business' => 'Mur Château ministre de Georgie', 'kilometers' => 12.7],
            ['code' => '123010', 'city' => 'FONTAINEBLEAU', 'address' => '-', 'business' => 'Château de Fontainebleau', 'kilometers' => 42.4],
            ['code' => '123012', 'city' => 'VAUX LE VICOMTE', 'address' => '-', 'business' => 'Château de Vaux Le Vicomte', 'kilometers' => 35.6],
            ['code' => '123013', 'city' => 'TOURNAN EN BRIE', 'address' => '1 Place Edmond Rothschild', 'business' => 'Hôtel de ville', 'kilometers' => 46.3],
            ['code' => '123014', 'city' => 'MEUDON', 'address' => '15 rue Porto Riche', 'business' => 'Chapelle ST Georges', 'kilometers' => 41.7],
            ['code' => '124001', 'city' => 'SAINT VRAIN', 'address' => '6 Place de la croix blanch', 'business' => 'EGLISE', 'kilometers' => 1.4],
            ['code' => '124001', 'city' => 'ST MICHEL SUR ORGE', 'address' => '9 rue d\'enfer', 'business' => 'Eglise St Michel', 'kilometers' => 13.7],
            ['code' => '124001', 'city' => 'GRIGNY', 'address' => '13 rue Pierre Brossolette', 'business' => 'Eglise de Grigny', 'kilometers' => 18.3],
            ['code' => '124001', 'city' => 'ORSAY', 'address' => 'Rue de Lozère', 'business' => 'Reconstruction d\'un mur', 'kilometers' => 30.2],
            ['code' => '124001', 'city' => 'BONNELLES', 'address' => 'Rue du clos berger', 'business' => 'Refection mur du presbytère', 'kilometers' => 28.5],
            ['code' => '124001', 'city' => 'PARIS', 'address' => '244 Boulevard Saint Germain', 'business' => 'Ministère de l\'écologie', 'kilometers' => 43.4],
            ['code' => '124001', 'city' => 'PARIS', 'address' => '84 avenue Georges V', 'business' => 'Buste Abraham Lincoln', 'kilometers' => 49],
            ['code' => '124001', 'city' => 'ORSAY', 'address' => '1 rue de la Troche', 'business' => 'Mr Ascoet', 'kilometers' => 30.2],
            ['code' => '124001', 'city' => 'CERNY', 'address' => 'Château de Cerny', 'business' => 'M. Dekerenger', 'kilometers' => 11.2],
            ['code' => '124001', 'city' => 'MONTGERON', 'address' => '130 Avenue Charles de Gaulle', 'business' => 'Eglise', 'kilometers' => 24.9],
            ['code' => '124001', 'city' => 'PARIS', 'address' => '3 Rue du General Clergerie', 'business' => 'Particulier', 'kilometers' => 50],
            ['code' => '124002', 'city' => 'PARIS', 'address' => '4 rueValette', 'business' => 'Bibliothèque Ste Barbe', 'kilometers' => 42.2],
            ['code' => '124003', 'city' => 'GALLUIS', 'address' => '1 rue de la Mairie', 'business' => 'Mairie', 'kilometers' => 57],
            ['code' => '124004', 'city' => 'YERRES', 'address' => '8 rue de Concy', 'business' => 'Maison Caillebotte', 'kilometers' => 32.2],
            ['code' => '124005', 'city' => 'ST MICHEL SUR ORGE', 'address' => '16 rue de l\'Eglise', 'business' => 'Hôtel de ville', 'kilometers' => 15.2],
            ['code' => '124006', 'city' => 'PARIS 11', 'address' => 'Rue de la Folie-Méricourt', 'business' => 'Façades', 'kilometers' => 48.9],
            ['code' => '124007', 'city' => 'LOUVECIENNES', 'address' => '34 rue de Voisins', 'business' => 'Pigeionnier', 'kilometers' => 54],
            ['code' => '124008', 'city' => 'MAROLLES EN HUREPOIX', 'address' => 'Grande rue', 'business' => 'Rénovation du pigeonnier', 'kilometers' => 2.9],
            ['code' => '220001', 'city' => 'MONTGERON', 'address' => '42 rue des saules', 'business' => 'Maison de retraite', 'kilometers' => 25.1],
            ['code' => '220002', 'city' => 'PARIS', 'address' => 'Face au 14 rue de Bourgogne / 32 rue Las Cases', 'business' => 'Assemblée Nationale - hotel de BROGLIE', 'kilometers' => 45.1],
            ['code' => '221001', 'city' => 'EVRY', 'address' => '8 rue Georges Brassens', 'business' => 'Lycée G Brassens', 'kilometers' => 15.9],
            ['code' => '222002', 'city' => 'PARIS 6EME', 'address' => '60 boulevard St Michel', 'business' => 'Ecole des Mines', 'kilometers' => 43.2],
            ['code' => '222007', 'city' => 'DRAVEIL', 'address' => '6b BD Henri Barbusse / 2 Rue de Villiers', 'business' => 'conservatoire de musique', 'kilometers' => 21.3],
            ['code' => '222008', 'city' => 'MARCOUSSIS', 'address' => '44 rue Alfred Dubois', 'business' => '18 logements', 'kilometers' => 18.4],
            ['code' => '223008', 'city' => 'OLLAINVILLE', 'address' => 'rue de la république', 'business' => 'Logements', 'kilometers' => 11.7],
            ['code' => '223009', 'city' => 'ETAMPES', 'address' => 'Avenue Charles de Gaulle', 'business' => 'Restaurant Base de Loisirs', 'kilometers' => 21.8],
            ['code' => '223010', 'city' => 'PARIS', 'address' => '129 rue de Grenelle', 'business' => 'Musée de l\'armée - Porche des Invalides', 'kilometers' => 44.9],
            ['code' => '223011', 'city' => 'MAROLLES EN HUREPOIX', 'address' => '11 Grande Rue', 'business' => '11 Logements', 'kilometers' => 2.9],
            ['code' => '223014', 'city' => 'MONTIGNY-LE-BRETONNEUX', 'address' => '1 rue Stephenson', 'business' => 'Le Stephenson', 'kilometers' => 45.9],
            ['code' => '223015', 'city' => 'L\'HAY LES ROSES', 'address' => '22 rue des jardins', 'business' => 'SCI AERTOIT', 'kilometers' => 34.7],
            ['code' => '223016', 'city' => 'LARDY', 'address' => 'Route Nationale', 'business' => 'Ancienne halle SNCF', 'kilometers' => 3.6],
            ['code' => '223017', 'city' => 'MARCOUSSIS', 'address' => '53 Chemin de la Ronce', 'business' => '3 F', 'kilometers' => 21.7],
            ['code' => '224001', 'city' => 'MOIGNY SUR ECOLE', 'address' => '1 Rue Marie Louise Fuga', 'business' => 'Coursive de Moigny', 'kilometers' => 22.6],
            ['code' => '224002', 'city' => 'LARDY', 'address' => '1 Allée Cornuel', 'business' => 'Renault SAS', 'kilometers' => 5],
            ['code' => '224003', 'city' => 'VIRY CHATILLON', 'address' => '1-15 Avenue du Président Kennedy', 'business' => 'Renault F1 (Alpine)', 'kilometers' => 17.7],
            ['code' => '224004', 'city' => 'MONTLHERY', 'address' => 'Rue de Longpont', 'business' => 'Eneria', 'kilometers' => 15.4],
            ['code' => '224005', 'city' => 'DOURDAN', 'address' => '-', 'business' => 'Hôtel dieu', 'kilometers' => 0],
            ['code' => '224006', 'city' => 'GRIGNY', 'address' => '-', 'business' => 'Grange/Salle conseil municipal', 'kilometers' => 0],
            ['code' => '224007', 'city' => 'SAINT CLOUD', 'address' => '8 Rue Emile Verhaeren', 'business' => 'Ecole Saint Joseph', 'kilometers' => 49.6],
            ['code' => '224008', 'city' => 'ST MICHEL SUR ORGE', 'address' => 'Rue de la Mare des Bordes', 'business' => 'Ecole Jules Verne', 'kilometers' => 14.1],
            ['code' => '224009', 'city' => 'GIGNY', 'address' => '14 Avenue des Tuilleries', 'business' => 'Ecole Paul Langevin', 'kilometers' => 18],
            ['code' => '224010', 'city' => 'LARDY', 'address' => '1 Allée Cornuel', 'business' => 'Serma - Renault', 'kilometers' => 5],
            ['code' => '224011', 'city' => 'LEUDEVILLE', 'address' => '60 rue de la Croix Boissée', 'business' => 'Ferme de Leudeville', 'kilometers' => 3.9],
            ['code' => '224012', 'city' => 'FONTENAY AUX ROSES', 'address' => 'Route du Panorama', 'business' => 'CEA', 'kilometers' => 36.1],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
