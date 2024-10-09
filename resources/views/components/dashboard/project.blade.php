{{--project.blade.php--}}
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
                        <x-side-link href="{{ route('dashboard.show') }}" :active="request()->routeIs('dashboard.show')"
                                     class="flex">
                            <svg
                                class="{{ request()->routeIs('dashboard.show') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                                <path
                                    d="M261.56,101.28a8,8,0,0,0-11.06,0L66.4,277.15a8,8,0,0,0-2.47,5.79L63.9,448a32,32,0,0,0,32,32H192a16,16,0,0,0,16-16V328a8,8,0,0,1,8-8h80a8,8,0,0,1,8,8l0,136a16,16,0,0,0,16,16h96.06a32,32,0,0,0,32-32l0-165.06a8,8,0,0,0-2.47-5.79Z"></path>
                                <path
                                    d="M490.91,244.15l-74.8-71.56,0-108.59a16,16,0,0,0-16-16h-48a16,16,0,0,0-16,16l0,32L278.19,40.62C272.77,35.14,264.71,32,256,32h0c-8.68,0-16.72,3.14-22.14,8.63L21.16,244.13c-6.22,6-7,15.87-1.34,22.37A16,16,0,0,0,43,267.56L250.5,69.28a8,8,0,0,1,11.06,0L469.08,267.56a16,16,0,0,0,22.59-.44C497.81,260.76,497.3,250.26,490.91,244.15Z"></path>
                            </svg>
                            Tableau de bord
                        </x-side-link>
                    </li>
                    @if(auth()->user()->hasRole('Administrateur') || auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Conducteur'))
                        <li class="mb-2">
                            <x-side-link href="{{ route('dashboard.showProject') }}"
                                         :active="request()->routeIs('dashboard.showProject')" class="flex">
                                <svg
                                    class="{{ request()->routeIs('dashboard.showProject') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M4.606 12.97a.75.75 0 0 1-.134 1.051 2.494 2.494 0 0 0-.93 2.437 2.494 2.494 0 0 0 2.437-.93.75.75 0 1 1 1.186.918 3.995 3.995 0 0 1-4.482 1.332.75.75 0 0 1-.461-.461 3.994 3.994 0 0 1 1.332-4.482.75.75 0 0 1 1.052.134Z"
                                          clip-rule="evenodd"></path>
                                    <path fill-rule="evenodd"
                                          d="M5.752 12A13.07 13.07 0 0 0 8 14.248v4.002c0 .414.336.75.75.75a5 5 0 0 0 4.797-6.414 12.984 12.984 0 0 0 5.45-10.848.75.75 0 0 0-.735-.735 12.984 12.984 0 0 0-10.849 5.45A5 5 0 0 0 1 11.25c.001.414.337.75.751.75h4.002ZM13 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                Par Chantier
                            </x-side-link>
                        </li>
                    @endif
                    @if(auth()->user()->hasRole('Administrateur') || auth()->user()->hasRole('Super Admin'))
                        <li class="mb-2">
                            <x-side-link href="{{ route('dashboard.showEmployee') }}"
                                         :active="request()->routeIs('dashboard.showEmployee')" class="flex">
                                <svg
                                    class="{{ request()->routeIs('dashboard.showEmployee') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                          d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                Par Salarié
                            </x-side-link>
                        </li>
                    @endif
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 pt-4">
            <div class="flex gap-2 flex-col mb-2">
                <!-- Formulaire de Filtrage par Statut des Employés -->
                <form class="flex items-center gap-5" action="{{ route('dashboard.showProject') }}" method="GET">
                    @csrf
                    <div class="flex">
                        <label for="project_id" class="sr-only">Choisir un chantier</label>
                        <select name="project_id" id="project_id" class="w-auto bg-white border border-gray-300 text-gray-900 font-bold text-sm rounded-lg focus:ring-customColor focus:border-customColor block" required>
                            <option disabled selected value="">Choisir un chantier</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->code }} - {{ $project->business }} - {{ $project->city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Boutons radio pour filtrer par statut des salariés -->
                    <div class="flex items-center ps-4 pe-4 bg-white border border-gray-300 rounded-lg dark:border-gray-700">
                        <input id="radio-all" type="radio" value="" name="employee_status" class="w-4 h-4 text-customColor border-gray-300 focus:ring-customColor" checked>
                        <label for="radio-all" class="w-full py-2 mx-2 text-gray-900 font-bold text-sm">Tous</label>
                    </div>
                    <div class="flex items-center ps-4 pe-4 bg-white border border-gray-300 rounded-lg dark:border-gray-700">
                        <input id="radio-ouvrier" type="radio" value="OUVRIER" name="employee_status" class="w-4 h-4 text-customColor border-gray-300 focus:ring-customColor">
                        <label for="radio-ouvrier" class="w-full py-2 mx-2 text-gray-900 font-bold text-sm">OUVRIER</label>
                    </div>
                    <div class="flex items-center ps-4 pe-4 bg-white border border-gray-300 rounded-lg dark:border-gray-700">
                        <input id="radio-etam" type="radio" value="ETAM" name="employee_status" class="w-4 h-4 text-customColor border-gray-300 focus:ring-customColor">
                        <label for="radio-etam" class="w-full py-2 mx-2 text-gray-900 font-bold text-sm">ETAM</label>
                    </div>
                    <div class="flex items-center ps-4 pe-4 bg-white border border-gray-300 rounded-lg dark:border-gray-700">
                        <input id="radio-interimaire" type="radio" value="INTERIMAIRE" name="employee_status" class="w-4 h-4 text-customColor border-gray-300 focus:ring-customColor">
                        <label for="radio-interimaire" class="w-full py-2 mx-2 text-gray-900 font-bold text-sm">INTERIMAIRE</label>
                    </div>
                </form>

                <!-- Navigation du mois -->
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text">
                        <!-- Bouton mois précédent -->
                        <li>
                            <button type="button" id="prev-month-btn" class="group flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-customColor hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-4 h-4 text-gray-900 dark:text-white group-hover:text-white transition-transform duration-100 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                                </svg>
                            </button>
                        </li>

                        <!-- Mois et année -->
                        <li>
                            <span id="month-year" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-900 font-bold text-sm bg-white border border-gray-300 hover:cursor-default dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                  style="width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; text-align: center;">
                            </span>
                        </li>

                        <!-- Bouton mois suivant -->
                        <li>
                            <button type="button" id="next-month-btn" class="group flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-customColor hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-4 h-4 text-gray-900 dark:text-white group-hover:text-white transition-transform duration-100 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Conteneur du tableau -->
            <div id="project-table-container" class="bg-white p-6 rounded-lg shadow-md col-span-2" hidden>
                <h3 class="text-xl font-semibold mb-4 flex justify-between">
                    <span>Tableau coût et heure :</span>
                    <span id="selected-project-name"></span>
                    <span id="selected-project-type" class="px-1 font-medium rounded"></span>
                </h3>
                <!-- Table HTML du projet avec ligne total -->
                <table id="project" class="min-w-full bg-white text-sm">
                    <thead>
                    <tr class="w-full">
                        <th class="py-1 px-2 text-left">Salariés</th>
                        <th class="py-1 px-2 text-left">Heures pour le mois</th>
                        <th class="py-1 px-2 text-left">Coûts pour le mois (€)</th>
                        <th class="py-1 px-2 text-left">Heures depuis le début</th>
                        <th class="py-1 px-2 text-left">Coût depuis le début (€)</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr class="font-bold border-t border-stroke">
                        <td class="py-1 px-2 text-left">Total</td>
                        <td class="py-1 px-2 text-left" id="total-monthly-hours">-</td>
                        <td class="py-1 px-2 text-left" id="total-monthly-cost">-</td>
                        <td class="py-1 px-2 text-left" id="total-hours">-</td>
                        <td class="py-1 px-2 text-left" id="total-cost">-</td>
                    </tr>
                    </tfoot>

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
        $(document).ready(function() {
            let currentMonth = new Date().getMonth() + 1;
            let currentYear = new Date().getFullYear();

            // Initialisation de DataTables sans footerCallback
            var projectTable = $('#project').DataTable({
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
                lengthChange: false,
                paging: false,
                info: false,
                ordering: false,
            });

            // Mettre à jour l'affichage du mois et de l'année
            function updateMonthYearDisplay() {
                const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
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
                loadProjectData();
            });

            $('#next-month-btn').click(function() {
                if (currentMonth === 12) {
                    currentMonth = 1;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                updateMonthYearDisplay();
                loadProjectData();
            });

            // Fonction pour charger les données du projet sélectionné en fonction du mois, de l'année, et du statut des employés
            function loadProjectData() {
                let projectId = $('#project_id').val();
                let projectName = $('#project_id option:selected').text();
                let employeeStatus = $('input[name="employee_status"]:checked').val(); // Statut de l'employé sélectionné
                let url = "{{ route('dashboard.getProjectData') }}";
                let token = '{{ csrf_token() }}';

                if (!projectId) return;

                // Mettre à jour le nom du projet dans le titre
                $('#selected-project-name').text(projectName);

                // Afficher le tableau
                $('#project-table-container').show();

                // Envoyer la requête AJAX avec le mois, l'année et le statut sélectionné
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        project_id: projectId,
                        month: currentMonth,
                        year: currentYear,
                        employee_status: employeeStatus,
                        _token: token
                    },
                    success: function(response) {
                        console.log(response); // Pour déboguer

                        // Mettre à jour le statut de l'employé
                        let statusElement = $('#selected-employee-status');
                        let employeeStatus = response.employeeStatus;

                        if (employeeStatus) {
                            statusElement.text(employeeStatus);

                            // Retirer les anciennes classes de statut
                            statusElement.removeClass('text-green-500 text-red-500 text-blue-500 border-green-500 border-red-500 border-blue-500 bg-red-100 bg-green-100 bg-blue-100');

                            // Ajouter les classes en fonction du statut
                            switch (employeeStatus) {
                                case 'OUVRIER':
                                    statusElement.addClass('text-green-500 border-green-500 bg-green-100');
                                    break;
                                case 'ETAM':
                                    statusElement.addClass('text-red-500 border-red-500 bg-red-100');
                                    break;
                                case 'INTERIMAIRE':
                                    statusElement.addClass('text-blue-500 border-blue-500 bg-blue-100');
                                    break;
                                default:
                                    // Classe pour un statut inconnu
                                    statusElement.addClass('');
                                    break;
                            }
                        } else {
                            statusElement.text('Tous');
                        }

                        // Mettre à jour le type de projet
                        let projectTypeElement = $('#selected-project-type');
                        let projectType = response.projectType;

                        if (projectType) {
                            projectTypeElement.text(projectType);

                            switch (projectType) {
                                case 'Monument Historique':
                                    projectTypeElement.removeClass('bg-yellow-100 text-yellow-500 border-yellow-500 border-2');
                                    projectTypeElement.addClass('bg-green-100 text-green-500 border-green-500 border-2');
                                    break;
                                case 'Gros Œuvre':
                                    projectTypeElement.removeClass('bg-green-100 text-green-500 border-green-500 border-2');
                                    projectTypeElement.addClass('bg-yellow-100 text-yellow-500 border-yellow-500 border-2');
                                    break;
                                default:
                                    projectTypeElement.addClass('');
                                    break;
                            }
                        } else {
                            projectTypeElement.text('Tous');
                        }

                        // Mettre à jour les totaux dans le footer
                        $('#total-monthly-hours').html(response.totalMonthlyHours > 0 ? response.totalMonthlyHours + ' H' : '-');
                        $('#total-monthly-cost').html(response.totalMonthlyCost > 0 ? response.totalMonthlyCost.toFixed(2) + ' €' : '-');
                        $('#total-hours').html(response.totalHours > 0 ? response.totalHours + ' H' : '-');
                        $('#total-cost').html(response.totalCost > 0 ? response.totalCost.toFixed(2) + ' €' : '-');

                        // Utiliser l'API DataTables pour manipuler les données
                        projectTable.clear();

                        if (response.employeeCosts.length > 0) {
                            $.each(response.employeeCosts, function(index, employee) {
                                projectTable.row.add([
                                    employee.employee_name,
                                    employee.monthly_hours > 0 ? employee.monthly_hours + ' H' : '-', // Heures pour le mois
                                    employee.monthly_cost > 0 ? employee.monthly_cost.toFixed(2) + ' €' : '-', // Coûts pour le mois
                                    employee.total_hours > 0 ? employee.total_hours + ' H' : '-', // Heures depuis le début
                                    employee.total_cost > 0 ? employee.total_cost.toFixed(2) + ' €' : '-' // Coût depuis le début
                                ]);
                            });
                        }

                        // Redessiner le tableau
                        projectTable.draw();
                    },
                    error: function(xhr, status, error) {
                        console.log('Erreur lors du chargement des données du projet :', error);
                    }
                });
            }

            // Lorsque l'utilisateur sélectionne un projet, charger les données pour le mois en cours
            $('#project_id').change(function() {
                loadProjectData();
            });

            // Lorsque l'utilisateur change de statut via les boutons radio, recharger les données
            $('input[name="employee_status"]').change(function() {
                loadProjectData();
            });

            // Charger les données initiales si un projet est déjà sélectionné (utile lors de rechargement)
            @if(request()->routeIs('dashboard.showProject') && request()->has('project_id'))
            loadProjectData();
            @endif
        });
    </script>
</x-app-layout>
