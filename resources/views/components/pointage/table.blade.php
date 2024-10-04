<div class="mx-10 flex justify-center">
    <div class="bg-white shadow-md rounded-md p-6 dark:bg-customGray min-w-full mb-10">
        <!-- Titre avec navigation entre mois -->
        <div class="text-2xl font-bold flex items-center justify-between border rounded py-6 bg-gray-100 dark:bg-customGrayLight dark:border-customGray">

            <!-- Code Title à gauche (milieu à gauche) -->
            <h1 id="code-title" class="flex-1 flex justify-center dark:text-white"></h1>

            <!-- Votre conteneur principal -->
            <div class="flex gap-2 flex-col">
                <!-- Navigation du mois adaptée -->
                <nav aria-label="">
                    <ul class="inline-flex -space-x-px text">
                        <!-- Bouton mois précédent -->
                        <li>
                            <button type="button" id="prev-month-btn" class="group flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-md hover:bg-customColor dark:bg-customGray dark:border-customGray dark:hover:border-customColor">
                                <svg class="w-6 h-6 text-gray-900 group-hover:text-white dark:text-white transition-transform duration-100 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                                </svg>
                            </button>
                        </li>

                        <!-- Mois et année -->
                        <li>
                            <span id="month-year" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-900 font-bold text-xl bg-white border border-gray-300 hover:cursor-default dark:bg-customGray dark:border-customGray dark:border-l-gray-500"
                                  style="width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; text-align: center;">
                            </span>
                        </li>

                        <!-- Bouton mois suivant -->
                        <li>
                            <button type="button" id="next-month-btn" class="group flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-md hover:bg-customColor dark:bg-customGray dark:border-customGray dark:hover:border-customColor dark:border-l-gray-500">
                                <svg class="w-6 h-6 text-gray-900 group-hover:text-white dark:text-white transition-transform duration-100 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Zone à droite (centré dans la partie droite) -->
            <h1 id="zone" class="flex-1 flex justify-center"></h1>

        </div>

        <!-- Formulaire de sélection d'heures -->
        <div class="mt-4 flex justify-center bg-white">
            <form id="month-navigation-form" action="{{ route('pointage.show') }}" method="GET">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="month" id="month-input" value="{{ $month }}">
                <input type="hidden" name="year" id="year-input" value="{{ $year }}">
                <input type="hidden" name="hour_type" value="{{ $hourType }}">

                @if(count($employeeData) > 0)
                    <div class="flex justify-center gap-4 p-2 bg-gray-100 border rounded my-5">
                        <button type="submit" name="hour_type" value="day_hours" class="border text-black font-bold py-2 px-4 rounded text-sm hover:bg-green-500 hover:text-white {{ $hourType === 'day_hours' ? 'bg-green-500 text-white' : 'bg-white' }}">Jour</button>
                        <button type="submit" name="hour_type" value="night_hours" class="border text-black font-bold py-2 px-4 rounded text-sm hover:bg-purple-500 hover:text-white {{ $hourType === 'night_hours' ? 'bg-purple-500 text-white' : 'bg-white' }}">Nuit</button>
                    </div>
                @endif
            </form>
        </div>

        <!-- Handsontable -->
        @if(count($employeeData) > 0)
            <div id="handsontable"></div>
        @else
            <p class="text-gray-500 dark:text-gray-400 text-sm font-normal">Chantier neuf ? </p>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-normal">Ajouter un salarié.</p>
        @endif

        <!-- Sauvegarde et ajout d'employé -->
        <div class="mt-4 mb-5 flex justify-between">
            <form class="flex items-center gap-4" action="{{ route('pointage.add', ['id' => $project->id]) }}" method="POST">
                @csrf
                <div class="flex">
                    <label for="employee" class="sr-only">Choisir un salarié</label>
                    <select name="employee_id" id="employee" class="w-auto bg-gray-100 border border-gray-300 text-gray-900 font-bold text-sm rounded-md focus:ring-customColor focus:border-customColor block dark:bg-customGrayLight dark:border-customGray dark:placeholder-gray-400 dark:text-white dark:focus:ring-customColor dark:focus:border-customColor">
                        <option selected disabled>Choisir un salarié</option>
                        @foreach ($allEmployees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->last_name }} {{ $employee->first_name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="month" value="{{ $month }}">
                <input type="hidden" name="year" value="{{ $year }}">
                <input type="hidden" name="hour_type" value="{{ $hourType }}">
                <div>
                    <button type="submit" class="bg-gray-100 text-black font-bold py-2 px-4 rounded text-sm hover:bg-customColor hover:text-white border border-gray-300 dark:bg-customGrayLight dark:border-customGrayLight dark:text-white">Ajouter un salarié</button>
                </div>
            </form>
            @if(count($employeeData) > 0)
            <button id="save" class="bg-customColor hover:scale-110 text-black font-bold py-2 px-4 rounded text-sm hover:bg-customColor hover:text-white border border-gray-300 dark:bg-customColor dark:border-customGrayLight dark:text-white dark:hover:scale-110">Sauvegarder</button>
            @endif
        </div>

        @if(count($employeeData) > 0)
        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-500">

        <!-- Tableau total des heures -->
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <caption class="pb-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-customGray">
                    Totaux d'heures par salarié
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                        Ce tableau affiche le total des heures travaillées par salarié pour chaque type d'heure (jour, nuit) durant le mois sélectionné.
                    </p>
                </caption>
                <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-customGrayDark dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-1">salarié</th>
                    <th scope="col" class="px-6 py-1">Total heures Jour</th>
                    <th scope="col" class="px-6 py-1">Total heures Nuit</th>
                    <th scope="col" class="px-6 py-1">Total heures</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalDayHours = 0;
                    $totalNightHours = 0;
                @endphp

                @foreach ($employeeData as $employee)
                    @php
                        // Accumuler les heures de jour et de nuit pour chaque employé
                        $totalDayHours += $employee['total_day_hours'];
                        $totalNightHours += $employee['total_night_hours'];
                    @endphp
                    <tr class="bg-white border-b dark:bg-customGrayLight dark:border-gray-700 dark:text-white">
                        @if ($employee['archived'])
                            <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $employee['full_name'] }} <span class="text-xs text-red-500 dark:text-red-400">(Archivé)</span>
                            </th>
                        @else
                            <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $employee['full_name'] }}
                            </th>
                        @endif
                        <td class="px-6 py-1">
                            {{ $employee['total_day_hours'] == 0 ? '-' : $employee['total_day_hours'].' H' }} <!-- Total heures Jour -->
                        </td>
                        <td class="px-6 py-1">
                            {{ $employee['total_night_hours'] == 0 ? '-' : $employee['total_night_hours'].' H' }} <!-- Total heures Nuit -->
                        </td>
                        <td class="px-6 py-1">
                            {{ $employee['total_hours'] == 0 ? '-' : $employee['total_hours'].' H' }} <!-- Total heures -->
                    </tr>
                @endforeach

                <!-- Ligne de cumul des heures pour tous les salariés -->
                <tr class="text-gray-700 uppercase bg-gray-200 dark:bg-customGrayDark dark:text-gray-400">
                    <th scope="row" class="px-6 py-1 font-bold text-gray-700 dark:text-white text-sm">Cumul du mois</th>
                    <td class="px-6 py-1 font-extrabold">
                        {{ $totalDayHours == 0 ? '-' : $totalDayHours.' H' }} <!-- Total cumulé des heures Jour -->
                    </td>
                    <td class="px-6 py-1 font-extrabold">
                        {{ $totalNightHours == 0 ? '-' : $totalNightHours.' H' }} <!-- Total cumulé des heures Nuit -->
                    </td>
                    <td class="px-6 py-1 font-extrabold">
                        {{ $totalDayHours + $totalNightHours == 0 ? '-' : ($totalDayHours + $totalNightHours).' H' }} <!-- Total cumulé des heures -->
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

<!-- Script pour la gestion de la navigation entre les mois et Handsontable -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var project_id = document.body.getAttribute('data-project-id') !== 'null' ? parseInt(document.body.getAttribute('data-project-id')) : null;
        var projectCode = document.body.getAttribute('data-project-code') !== 'null' ? document.body.getAttribute('data-project-code') : null;
        var projectZone = document.body.getAttribute('data-project-zone') !== 'null' ? document.body.getAttribute('data-project-zone') : null;
        var projectBusiness = document.body.getAttribute('data-project-business') !== 'null' ? document.body.getAttribute('data-project-business') : null;
        var month = document.body.getAttribute('data-month') !== 'null' ? parseInt(document.body.getAttribute('data-month')) : null;
        var year = document.body.getAttribute('data-year') !== 'null' ? parseInt(document.body.getAttribute('data-year')) : null;
        var employeeData = @json($employeeData);
        var nonWorkingDays = @json($nonWorkingDays);  // Ajouter la récupération des jours non travaillés
        const months = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        // Mise à jour du titre
        if (month && year && projectCode && projectBusiness) {
            document.getElementById('code-title').innerHTML = `<span class="text-black dark:text-white px-2 py-1 uppercase">${projectCode} - ${projectBusiness}</span>`;
            document.getElementById('month-year').innerHTML = `<span class="text-black dark:text-white px-2 py-1">${months[month - 1]} ${year}</span>`;
            document.getElementById('zone').innerHTML = `<span class="text-black dark:text-white px-2 py-1 uppercase">Zone ${projectZone}</span>`;
        }

        // Obtenir le nombre de jours dans un mois
        function getDaysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }

        // Fonction pour déterminer si un jour est un weekend
        function isWeekend(date) {
            const day = date.getDay();
            return day === 0 || day === 6;
        }

        // Fonction pour vérifier si une date est un jour non travaillé
        function isNonWorkingDay(date) {
            const formattedDate = date.toISOString().split('T')[0];  // Format YYYY-MM-DD
            return nonWorkingDays.includes(formattedDate);
        }

        var container = document.getElementById('handsontable');
        var daysInMonth = month && year ? getDaysInMonth(month, year) : 0;
        var weekends = month && year ? Array.from({ length: daysInMonth }, (_, i) => {
            let date = new Date(year, month - 1, i + 1);
            return isWeekend(date) ? i + 3 : null;
        }).filter(index => index !== null) : []; // +3 pour compenser le décalage des colonnes

        // Ajouter un tableau pour stocker les suppressions
        let deletedTimeTrackings = [];

        var hot = new Handsontable(container, {
            data: employeeData,
            colHeaders: ['id salarié chantier', 'id salarié', 'Salarié', ...Array.from({ length: daysInMonth }, (_, i) => i + 1)],
            columns: [
                { data: 'employee_project_id', readOnly: true },
                { data: 'employee_id', readOnly: true },
                { data: 'full_name', readOnly: true, sortIndicator: false },
                ...Array.from({ length: daysInMonth }, (_, i) => ({
                    data: `days.${i}`,
                    type: 'numeric',
                    validator: Handsontable.validators.NumericValidator,
                    allowInvalid: false,
                }))
            ],
            rowHeaders: true,
            manualColumnResize: true,
            height: 'auto',
            manualRowResize: true,
            contextMenu: false,
            filters: true,
            dropdownMenu: false,
            hiddenColumns: {
                columns: [0, 1],
                indicators: false
            },
            cells: function (row, col, prop) {
                const cellProperties = {};
                const employee = employeeData[row];  // Récupérer les données de l'employé pour cette ligne

                // Vérifier si l'employé est archivé
                const isArchived = employee.archived;

                // Appliquer un style au nom de l'employé si archivé (colonne du nom = 2)
                if (col === 2 && isArchived) {
                    cellProperties.renderer = function (instance, td) {
                        td.classList.add('employeeArchived');  // Fond gris pour les employés archivés
                        Handsontable.renderers.TextRenderer.apply(this, arguments);  // Appliquer le rendu du texte
                    };
                }

                if (col >= 3) { // Colonnes des jours du mois
                    const date = new Date(year, month - 1, col - 1);  // Obtenir la date correspondant à la colonne
                    const isNonWorking = isNonWorkingDay(date);  // Vérifier si c'est un jour non travaillé

                    cellProperties.renderer = function (instance, td, row, col, prop, value) {
                        Handsontable.renderers.TextRenderer.apply(this, arguments);

                        // Convertir la valeur en nombre
                        const numericValue = parseFloat(value);

                        // Récupérer le type d'heure actuel
                        const hourType = document.querySelector('form button[name="hour_type"].bg-green-500, form button[name="hour_type"].bg-purple-500, form button[name="hour_type"].bg-yellow-500, form button[name="hour_type"].bg-cyan-500').value;

                        // Appliquer la couleur en conséquence pour les heures normales
                        if (!isNaN(numericValue)) {
                            if (numericValue === 0) {
                                td.style.backgroundColor = '#ffcccc'; // Rouge pour la valeur 0
                            } else if (numericValue >= 1 && numericValue <= 12) {
                                if (hourType === 'day_hours') {
                                    td.style.backgroundColor = '#ccffcc'; // Vert clair pour day_hours
                                } else if (hourType === 'night_hours') {
                                    td.style.backgroundColor = '#e6ccff'; // Violet clair pour night_hours
                                }
                            }
                        } else {
                            td.style.backgroundColor = ''; // Couleur par défaut pour les autres valeurs
                        }

                        // Appliquer une couleur différente pour les weekends
                        if (weekends.includes(col)) {
                            td.classList.add('weekend');
                        }

                        // Appliquer une couleur grisée pour les jours non travaillés
                        if (isNonWorking) {
                            td.classList.add('nonWorkingDay');  // Griser la cellule
                        }

                        // Appliquer un style grisé si l'employé est archivé
                        if (isArchived) {
                            td.classList.add('employeeArchived');  // Fond gris pour les employés archivés
                        }
                    };
                }
                return cellProperties;
            },
            licenseKey: 'non-commercial-and-evaluation'
    });

        // Fonction pour afficher un message d'erreur ou de succès
        function showMessage(message, type) {
            const successContainer = document.getElementById('message-container-success');
            const errorContainer = document.getElementById('message-container-error');

            if (type === 'success') {
                successContainer.style.display = 'block';
                successContainer.querySelector('#success-message-text').textContent = message;
                errorContainer.style.display = 'none';
            } else if (type === 'error') {
                errorContainer.style.display = 'block';
                errorContainer.querySelector('#error-message-text').textContent = message;
                successContainer.style.display = 'none';
            }

            // Cacher le message après 4 secondes
            setTimeout(() => {
                successContainer.style.display = 'none';
                errorContainer.style.display = 'none';
            }, 4000);
        }

        // Gestion de la sauvegarde
        document.getElementById('save').addEventListener('click', function() {
            const data = hot.getData();
            let hasValidHours = false;
            let validationError = false;
            let hasDeletions = false; // Indicateur pour vérifier les suppressions

            const formattedData = data.map(row => {
                const days = row.slice(3, daysInMonth + 3).map((day, index) => {
                    const value = day !== null && day !== undefined && day.toString().trim() !== '' ? parseFloat(day) : null;

                    if (value !== null) {
                        if (isNaN(value) || value < 0 || value > 12) {
                            validationError = true;
                        } else {
                            hasValidHours = true; // On a trouvé des heures valides
                        }
                    } else {
                        hasDeletions = true; // On a trouvé des suppressions
                    }

                    return value;
                });

                return {
                    employee_project_id: parseInt(row[0]),
                    employee_id: parseInt(row[1]),
                    project_id: project_id,
                    month: month,
                    year: year,
                    days: days
                };
            });

            if (validationError) {
                showMessage('Les heures doivent être des nombres compris entre 0 et 12 !', 'error');
                return;
            }

            if (!hasValidHours && !hasDeletions) {
                showMessage('Erreur : Aucune heure n\'a été saisie.', 'error');
                return;
            }

            // Envoyer les données au serveur
            fetch('{{ route('pointage.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    data: formattedData,
                    hour_type: document.querySelector('form button[name="hour_type"].bg-green-500, form button[name="hour_type"].bg-purple-500').value
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Stocker le message de succès dans sessionStorage
                        sessionStorage.setItem('successMessage', 'Données sauvegardées avec succès !');
                        // Recharger la page
                        location.reload();
                    } else {
                        showMessage('Erreur lors de la sauvegarde des données : ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    showMessage('Erreur de requête : ' + error.message, 'error');
                });
        });

        // Vérifier s'il y a un message de succès après le rechargement de la page
        window.addEventListener('load', () => {
            const successMessage = sessionStorage.getItem('successMessage');
            if (successMessage) {
                showMessage(successMessage, 'success');
                sessionStorage.removeItem('successMessage'); // Supprimer le message après affichage
            }
        });

        // Navigation mois précédent/suivant
        const prevMonthBtn = document.getElementById('prev-month-btn');
        const nextMonthBtn = document.getElementById('next-month-btn');
        const monthInput = document.getElementById('month-input');
        const yearInput = document.getElementById('year-input');
        const form = document.getElementById('month-navigation-form');

        prevMonthBtn.addEventListener('click', function() {
            let month = parseInt(monthInput.value);
            let year = parseInt(yearInput.value);

            if (month === 1) {
                month = 12;
                year--;
            } else {
                month--;
            }

            monthInput.value = month;
            yearInput.value = year;
            form.submit();
        });

        nextMonthBtn.addEventListener('click', function() {
            let month = parseInt(monthInput.value);
            let year = parseInt(yearInput.value);

            if (month === 12) {
                month = 1;
                year++;
            } else {
                month++;
            }

            monthInput.value = month;
            yearInput.value = year;
            form.submit();
        });
    });
</script>
