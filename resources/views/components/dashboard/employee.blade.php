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
        <main class="flex-1 p-6 pt-4">
            <div class="flex gap-10">
                <!-- Chantier -->
                <form class="flex justify-center items-center gap-4 mb-4" action="{{ route('dashboard.showEmployee') }}" method="GET">
                    @csrf
                    <div class="flex">
                        <label for="employee_id" class="sr-only">Choisir un salarié</label>
                        <select name="employee_id" id="employee_id" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 font-bold text-sm rounded-lg focus:ring-customColor focus:border-customColor block" required>
                            <option disabled selected value="">Choisir un salarié</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->last_name }}  {{ $employee->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <!-- Mois et année -->
                <div class="flex items-center justify-center gap-4 mb-3">
                    <!-- Bouton mois précédent -->
                    <button type="button" id="prev-month-btn">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white hover:scale-125" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                        </svg>
                    </button>

                    <!-- Mois et année -->
                    <h1 id="month-year" class="text-center font-medium"></h1>

                    <!-- Bouton mois suivant -->
                    <button type="button" id="next-month-btn">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white hover:scale-125" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Conteneur du tableau -->
            <div id="employee-table-container" class="bg-white p-6 rounded-lg shadow-md col-span-2" hidden>
                <h3 class="text-xl font-semibold mb-4 flex justify-between">
                    <span>Tableau Heures Coûts par salarié</span>
                    <span id="selected-employee-name">Sélectionnez un salarié</span>
                </h3>
                <!-- Table HTML du salarié -->
                <table id="employee-table" class="min-w-full bg-white text-sm">
                    <thead>
                    <tr class="w-full">
                        <th class="py-1 px-2 text-left">Chantiers</th>
                        <th class="py-1 px-2 text-center">Heures jour</th>
                        <th class="py-1 px-2 text-center">Heures nuit</th>
                        <th class="py-1 px-2 text-center">Coût</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
        // Ajax pour récupérer les données du salarié
        $(document).ready(function() {
            let currentMonth = new Date().getMonth() + 1; // Mois actuel
            let currentYear = new Date().getFullYear();

            // Mettre à jour l'affichage du mois et de l'année
            function updateMonthYearDisplay() {
                const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
                $('#month-year').text(`${monthNames[currentMonth - 1]} ${currentYear}`);
            }

            // Initialiser l'affichage
            updateMonthYearDisplay();

            // Gestion des clics sur les boutons mois précédent et mois suivant
            $('#prev-month-btn').click(function() {
                if (currentMonth === 1) {
                    currentMonth = 12;
                    currentYear--;
                } else {
                    currentMonth--;
                }
                updateMonthYearDisplay();
                loadEmployeeData(); // Recharger les données pour le mois précédent
            });

            $('#next-month-btn').click(function() {
                if (currentMonth === 12) {
                    currentMonth = 1;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                updateMonthYearDisplay();
                loadEmployeeData(); // Recharger les données pour le mois suivant
            });

            // Fonction pour charger les données du salarié sélectionné en fonction du mois et de l'année
            function loadEmployeeData() {
                let employeeId = $('#employee_id').val();
                let employeeName = $('#employee_id option:selected').text();
                let url = "{{ route('dashboard.getEmployeeData') }}"; // Adapter la route vers la bonne méthode pour obtenir les données du salarié
                let token = $('input[name="_token"]').val();

                if (!employeeId) return; // Si aucun salarié sélectionné, ne rien faire

                // Mettre à jour le nom du salarié dans le titre
                $('#selected-employee-name').text(employeeName);

                // Afficher le tableau
                $('#employee-table-container').show();

                // Envoyer la requête AJAX avec le mois et l'année sélectionnés
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        employee_id: employeeId,
                        month: currentMonth,
                        year: currentYear,
                        _token: token
                    },
                    success: function(response) {
                        console.log(response); // Ajouter un log pour voir les données retournées
                        // Vider le tableau avant de le remplir
                        $('#employee-table tbody').empty();

                        // Remplir le tableau avec les nouvelles données
                        $.each(response.projectData, function(index, project) {
                            let row = `<tr class="border-b border-stroke">
                                <td class="py-1 px-2">${project.project_name}</td>
                                <td class="py-1 px-2 text-center">${project.day_hours > 0 ? project.day_hours + ' H' : '-'}</td>
                                <td class="py-1 px-2 text-center">${project.night_hours > 0 ? project.night_hours + ' H' : '-'}</td>
                                <td class="py-1 px-2 text-center">${project.cost > 0 ? project.cost + ' €' : '-'}</td>
                            </tr>`;
                            $('#employee-table tbody').append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Erreur lors du chargement des données du salarié :', error);
                    }
                });
            }

            // Lorsque l'utilisateur sélectionne un salarié, charger les données pour le mois en cours
            $('#employee_id').change(function() {
                loadEmployeeData();
            });
        });

        // Initialisation de DataTables pour tableau des salariés
        $(document).ready(function() {
            $('#employee-table').DataTable({
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
                lengthChange: false,
                searching: false,
                paging: false,
                info: false
            });
        });
    </script>
</x-app-layout>
