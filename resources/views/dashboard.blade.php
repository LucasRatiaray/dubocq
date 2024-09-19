<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="flex mt-1 bg-gray-50">
        <!-- Sidebar -->
        <aside class="min-h-screen w-72 text-white">
            <!-- Menu -->
            <nav class="sticky top-0 my-6 pl-4 py-10">
                <ul>
                    <li class="mb-2">
                        <x-side-link href="{{ route('dashboard.show') }}" :active="request()->routeIs('dashboard.show')" class="flex">
                            <svg class="{{ request()->routeIs('dashboard.show') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                                <path d="M261.56,101.28a8,8,0,0,0-11.06,0L66.4,277.15a8,8,0,0,0-2.47,5.79L63.9,448a32,32,0,0,0,32,32H192a16,16,0,0,0,16-16V328a8,8,0,0,1,8-8h80a8,8,0,0,1,8,8l0,136a16,16,0,0,0,16,16h96.06a32,32,0,0,0,32-32l0-165.06a8,8,0,0,0-2.47-5.79Z"></path>
                                <path d="M490.91,244.15l-74.8-71.56,0-108.59a16,16,0,0,0-16-16h-48a16,16,0,0,0-16,16l0,32L278.19,40.62C272.77,35.14,264.71,32,256,32h0c-8.68,0-16.72,3.14-22.14,8.63L21.16,244.13c-6.22,6-7,15.87-1.34,22.37A16,16,0,0,0,43,267.56L250.5,69.28a8,8,0,0,1,11.06,0L469.08,267.56a16,16,0,0,0,22.59-.44C497.81,260.76,497.3,250.26,490.91,244.15Z"></path>
                            </svg>
                            Tableau de bord
                        </x-side-link>
                    </li>
                    <li class="mb-2">
                        <x-side-link href="{{ route('dashboard.showProject') }}" :active="request()->routeIs('dashboard.showProject')" class="flex">
                            <svg class="{{ request()->routeIs('dashboard.showProject') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.606 12.97a.75.75 0 0 1-.134 1.051 2.494 2.494 0 0 0-.93 2.437 2.494 2.494 0 0 0 2.437-.93.75.75 0 1 1 1.186.918 3.995 3.995 0 0 1-4.482 1.332.75.75 0 0 1-.461-.461 3.994 3.994 0 0 1 1.332-4.482.75.75 0 0 1 1.052.134Z" clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M5.752 12A13.07 13.07 0 0 0 8 14.248v4.002c0 .414.336.75.75.75a5 5 0 0 0 4.797-6.414 12.984 12.984 0 0 0 5.45-10.848.75.75 0 0 0-.735-.735 12.984 12.984 0 0 0-10.849 5.45A5 5 0 0 0 1 11.25c.001.414.337.75.751.75h4.002ZM13 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" clip-rule="evenodd"></path>
                            </svg>
                            Par Chantier
                        </x-side-link>
                    </li>
                    <li class="mb-2">
                        <x-side-link href="{{  route('dashboard.showEmployee') }}" :active="request()->routeIs('dashboard.showEmployee')" class="flex">
                            <svg class="{{ request()->routeIs('dashboard.showEmployee') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd"></path>
                            </svg>
                            Par Salarié
                        </x-side-link>
                    </li>
                </ul>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Contenu heure du tableau de bord -->
            <div class="grid grid-cols-3 gap-6 mb-20">
                <!-- Content Box 1: prend 2 colonnes : Table -->
                <div class="bg-white p-6 rounded-lg shadow-md col-span-2">
                    <h3 class="text-xl font-semibold mb-4">Tableau des heures par chantier - {{ now()->format('F Y') }}</h3>
                    <!-- Table HTML des heures -->
                    <table id="hourProjectsTable" class="min-w-full bg-white text-sm">
                        <thead>
                        <tr class="w-full">
                            <th class="py-1 px-2 text-left">Chantiers</th>
                            <th class="py-1 px-2 text-center">Heures réalisées mois en cours</th>
                            <th class="py-1 px-2 text-center">Heures réalisées depuis le début</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr class="border-b border-stroke">
                                <td class="py-1 px-2">{{ $project->business }} - {{ $project->city }}</td>
                                <td class="py-1 px-2 text-center">{{ $project->getHoursThisMonth() == 0 ? '-' : $project->getHoursThisMonth().' H' }}</td>
                                <td class="py-1 px-2 text-center">{{ $project->getTotalHours() == 0 ? '-' : $project->getTotalHours().' H' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Content Box 2 : Chart -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-center">Répartition des heures du mois en cours</h3>
                    <div>
                        <canvas id="hourChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Contenu coût du tableau de bord -->
            <div class="grid grid-cols-3 gap-6 mb-20">
                <!-- Content Box 1: prend 2 colonnes : Table -->
                <div class="bg-white p-6 rounded-lg shadow-md col-span-2">
                    <h3 class="text-xl font-semibold mb-4">Tableau des coûts par chantier - {{ now()->format('F Y') }}</h3>
                    <!-- Table HTML des coûts -->
                    <table id="costProjectsTable" class="min-w-full bg-white text-sm">
                        <thead>
                        <tr class="w-full">
                            <th class="py-1 px-2 text-left">Chantiers</th>
                            <th class="py-1 px-2 text-center">Coûts salariés mois en cours</th>
                            <th class="py-1 px-2 text-center">Coûts salariés depuis le début</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr class="border-b border-stroke">
                                <td class="py-1 px-2">{{ $project->business }} - {{ $project->city }}</td>
                                <td class="py-1 px-2 text-center">
                                    {{ $project->calculateMonthlyCost() == 0 ? '-' : number_format($project->calculateMonthlyCost(), 2).' €' }}
                                </td>
                                <td class="py-1 px-2 text-center">
                                    {{ $project->calculateTotalCost() == 0 ? '-' : number_format($project->calculateTotalCost(), 2).' €' }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Content Box 2 : Chart -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-center">Répartition des coûts du mois en cours</h3>
                    <div>
                        <canvas id="costChart"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        // Initialisation de DataTables pour tableau heure
        $(document).ready(function() {
            $('#hourProjectsTable').DataTable({
                language: {
                    "sEmptyTable": "Aucune donnée disponible dans le tableau",
                    "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ chantier(s)",
                    "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                    "sInfoFiltered": "(filtré de _MAX_ chantier(s) au total)",
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

        // Initialisation de Chart.js pour tableau heure
        const backgroundColors = [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'rgba(255, 44, 0, 0.6)',
            'rgba(42, 85, 191, 0.6)',
            'rgba(255, 165, 0, 0.6)',
            'rgba(128, 0, 128, 0.6)',
            'rgba(0, 128, 0, 0.6)',
            'rgba(0, 255, 255, 0.6)',
            'rgba(255, 20, 147, 0.6)',
            'rgba(128, 128, 0, 0.6)',
            'rgba(255, 192, 203, 0.6)',
            'rgba(135, 206, 235, 0.6)',
            'rgba(255, 228, 196, 0.6)',
            'rgba(210, 105, 30, 0.6)',
            'rgba(240, 230, 140, 0.6)',
        ];

        const borderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(255, 44, 0, 1)',
            'rgba(42, 85, 191, 1)',
            'rgba(255, 165, 0, 1)',
            'rgba(128, 0, 128, 1)',
            'rgba(0, 128, 0, 1)',
            'rgba(0, 255, 255, 1)',
            'rgba(255, 20, 147, 1)',
            'rgba(128, 128, 0, 1)',
            'rgba(255, 192, 203, 1)',
            'rgba(135, 206, 235, 1)',
            'rgba(255, 228, 196, 1)',
            'rgba(210, 105, 30, 1)',
            'rgba(240, 230, 140, 1)',
        ];

        const data = {
            labels: [
                @foreach($filteredProjects as $project)
                    '{!! addslashes($project->business) !!}',
                @endforeach
            ],
            datasets: [{
                label: 'Heures du mois en cours',
                data: [
                    @foreach($filteredProjects as $project)
                        {{ $project->getHoursThisMonth() }},
                    @endforeach
                ],
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            title: function() {
                                return '';
                            },
                            label: function(tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw || 0;
                                return `${label}: ${value} heures`;
                            },
                        },
                        bodyFont: {
                            size: 14, // Taille de la police
                            weight: 'bold', // Épaisseur de la police
                        },
                        padding: 10, // Espacement interne
                        boxPadding: 10, // Espacement autour de la boîte
                    },
                },
            },
        };

        const ctx = document.getElementById('hourChart');
        const hourChart = new Chart(ctx, config);

        // Initialisation de DataTables pour tableau coût
        $(document).ready(function() {
            $('#costProjectsTable').DataTable({
                language: {
                    "sEmptyTable": "Aucune donnée disponible dans le tableau",
                    "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ chantiers",
                    "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                    "sInfoFiltered": "(filtré de _MAX_ chantiers au total)",
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

        // Initialisation de Chart.js pour tableau coût
        const costData = {
            labels: [
                @foreach($costData as $data)
                    '{{ $data['project_name'] }}',
                @endforeach
            ],
            datasets: [{
                label: 'Coûts du mois en cours (€)',
                data: [
                    @foreach($costData as $data)
                        {{ $data['monthly_cost'] }},
                    @endforeach
                ],
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        };

        const costConfig = {
            type: 'doughnut',
            data: costData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            title: function() {
                                return '';
                            },
                            label: function(tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw || 0;
                                return `${label}: ${value} €`;
                            },
                        },
                        bodyFont: {
                            size: 14, // Taille de la police
                            weight: 'bold', // Épaisseur de la police
                        },
                        padding: 10, // Espacement interne
                        boxPadding: 10, // Espacement autour de la boîte
                    },
                },
            },
        };

        const costCtx = document.getElementById('costChart');
        const costChart = new Chart(costCtx, costConfig);

    </script>

</x-app-layout>
