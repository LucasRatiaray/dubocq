<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="min-h-screen w-72 text-white bg-gray-200">
            <!-- Menu -->
            <nav class="mt-6">
                <ul>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 font-bold hover:text-customColor">
                            (ici logo) Tableau de bord
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 font-bold hover:text-customColor">
                            (ici logo) Par Chantier
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 font-bold hover:text-customColor">
                            (ici logo) Par Salarié
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100">
            <!-- Contenu du tableau de bord -->
            <div class="grid grid-cols-3 gap-6 mb-20">
                <!-- Example Content Box 1: prend 2 colonnes -->
                <div class="bg-white p-6 rounded-lg shadow-md col-span-2">
                    <h3 class="text-xl font-semibold mb-4">Tableau des heures par chantier - {{ now()->format('F Y') }}</h3>
                    <!-- Table HTML -->
                    <table id="projects-table" class="min-w-full bg-white text-sm">
                        <thead>
                        <tr class="w-full">
                            <th class="py-1 px-2 text-left">Chantier</th>
                            <th class="py-1 px-2 text-center">Heures réalisées mois en cours</th>
                            <th class="py-1 px-2 text-center">Heures réalisées depuis le début</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr class="border-b border-stroke">
                                <td class="py-1 px-2">{{ $project->business }}</td>
                                <td class="py-1 px-2 text-center">{{ $project->getHoursThisMonth() == 0 ? '-' : $project->getHoursThisMonth().' H' }}</td>
                                <td class="py-1 px-2 text-center">{{ $project->getTotalHours() == 0 ? '-' : $project->getTotalHours().' H' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @php
                    $filteredProjects = $projects->filter(function ($project) {
                        return $project->getHoursThisMonth() > 0;
                    });
                @endphp

                    <!-- Example Content Box 2 -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-center">Répartition des heures du mois en cours</h3>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Inclure jQuery et DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Initialisation de DataTables -->
    <script>
        $(document).ready(function() {
            $('#projects-table').DataTable({
                language: {
                    "sEmptyTable": "Aucune donnée disponible dans le tableau",
                    "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                    "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                    "sLengthMenu": "Afficher _MENU_ entrées",
                    "sLoadingRecords": "Chargement...",
                    "sProcessing": "Traitement...",
                    "sSearch": "Rechercher :",
                    "sZeroRecords": "Aucun enregistrement correspondant trouvé",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sLast": "Dernier",
                        "sNext": "Suivant",
                        "sPrevious": "Précédent"
                    },
                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                    }
                },
                lengthChange: false
            });
        });

        const data = {
            labels: [
                @foreach($filteredProjects as $project)
                    '{{ $project->business }}',
                @endforeach
            ],
            datasets: [{
                label: 'Heures du mois en cours',
                data: [
                    @foreach($filteredProjects as $project)
                        {{ $project->getHoursThisMonth() }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw || 0;
                                return `${label}: ${value} heures`;
                            }
                        }
                    }
                }
            },
        };

        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, config);
    </script>

</x-app-layout>
