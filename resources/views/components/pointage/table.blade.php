<div class="mx-auto w-screen flex justify-center">
    <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-400" style="width: 92vw;">
        <!-- Titre avec navigation entre mois -->
        <div class="text-2xl font-bold flex justify-center items-center border rounded py-6 bg-gray-100 gap-4">
            <!-- Bouton mois précédent -->
            <button type="button" id="prev-month-btn" class="border bg-white text-black rounded">
                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                </svg>
            </button>

            <!-- Titre -->
            <h1 id="title"></h1>

            <!-- Bouton mois suivant -->
            <button type="button" id="next-month-btn" class="border bg-white text-black rounded">
                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>
            </button>
        </div>

        <!-- Formulaire de sélection d'heures -->
        <div class="mt-4 flex justify-center bg-white">
            <form id="month-navigation-form" action="{{ route('pointage.show') }}" method="GET">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="month" id="month-input" value="{{ $month }}">
                <input type="hidden" name="year" id="year-input" value="{{ $year }}">
                <input type="hidden" name="hour_type" value="{{ $hourType }}">

                <div class="flex justify-center gap-4 p-2 bg-gray-100 border rounded">
                    <button type="submit" name="hour_type" value="day_hours" class="border text-black font-bold py-2 px-4 rounded text-sm hover:bg-green-500 hover:text-white {{ $hourType === 'day_hours' ? 'bg-green-500 text-white' : 'bg-white' }}">Jour</button>
                    <button type="submit" name="hour_type" value="night_hours" class="border text-black font-bold py-2 px-4 rounded text-sm hover:bg-purple-500 hover:text-white {{ $hourType === 'night_hours' ? 'bg-purple-500 text-white' : 'bg-white' }}">Nuit</button>
                    <button type="submit" name="hour_type" value="holiday_hours" class="border text-black font-bold py-2 px-4 rounded text-sm hover:bg-yellow-500 hover:text-white {{ $hourType === 'holiday_hours' ? 'bg-yellow-500 text-white' : 'bg-white' }}">Férié</button>
                    <button type="submit" name="hour_type" value="rtt_hours" class="border text-black font-bold py-2 px-4 rounded text-sm hover:bg-cyan-500 hover:text-white {{ $hourType === 'rtt_hours' ? 'bg-cyan-500 text-white' : 'bg-white' }}">RTT</button>
                </div>
            </form>
        </div>

        <!-- Handsontable -->
        <div id="handsontable" class="w-full h-full mt-5"></div>

        <!-- Sauvegarde et ajout d'employé -->
        <div class="mt-4 mb-5 flex justify-between">
            <form class="flex items-center gap-4" action="{{ route('pointage.add', ['id' => $project->id]) }}" method="POST">
                @csrf
                <div class="flex">
                    <label for="employee" class="sr-only">Choisir un employé</label>
                    <select name="employee_id" id="employee" class="w-auto bg-gray-100 border border-gray-300 text-gray-900 font-bold text-sm rounded-lg focus:ring-customColor focus:border-customColor block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-customColor dark:focus:border-customColor">
                        <option selected disabled>Choisir un employé</option>
                        @foreach ($allEmployees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->last_name }} {{ $employee->first_name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="month" value="{{ $month }}">
                <input type="hidden" name="year" value="{{ $year }}">
                <input type="hidden" name="hour_type" value="{{ $hourType }}">
                <div>
                    <button type="submit" class="bg-gray-100 text-black font-bold py-2 px-4 rounded text-sm hover:bg-customColor hover:text-white border border-gray-300">Ajouter un employé</button>
                </div>
            </form>
            <button id="save" class="bg-gray-100 text-black font-bold py-2 px-4 rounded text-sm hover:bg-customColor hover:text-white border border-gray-300">Sauvegarder</button>
        </div>

        <!-- Tableau total des heures -->
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Totaux d'heures par employé
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Ce tableau affiche le total des heures travaillées par employé pour chaque type d'heure (jour, nuit, férié, RTT) durant le mois sélectionné.</p>
                </caption>
                <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-1">
                        Employé
                    </th>
                    <th scope="col" class="px-6 py-1">
                        Total heures Jour
                    </th>
                    <th scope="col" class="px-6 py-1">
                        Total heures Nuit
                    </th>
                    <th scope="col" class="px-6 py-1">
                        Total heures Férié
                    </th>
                    <th scope="col" class="px-6 py-1">
                        Total heures RTT
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalDayHours = 0;
                    $totalNightHours = 0;
                    $totalHolidayHours = 0;
                    $totalRTTHours = 0;
                @endphp
                @foreach ($employeeData as $employee)
                    @php
                        $dayHours = array_sum(array_map('floatval', $employee['days']));
                        $nightHours = array_sum(array_map('floatval', $employee['other_hours']['night_hours']));
                        $holidayHours = array_sum(array_map('floatval', $employee['other_hours']['holiday_hours']));
                        $rttHours = array_sum(array_map('floatval', $employee['other_hours']['rtt_hours']));

                        // Ajouter aux totaux globaux
                        $totalDayHours += $dayHours;
                        $totalNightHours += $nightHours;
                        $totalHolidayHours += $holidayHours;
                        $totalRTTHours += $rttHours;
                    @endphp
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $employee['full_name'] }}
                        </th>
                        <td class="px-6 py-1">
                            {{ array_sum(array_map('floatval', $employee['days'])) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ array_sum(array_map('floatval', $employee['other_hours']['night_hours'])) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ array_sum(array_map('floatval', $employee['other_hours']['holiday_hours'])) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ array_sum(array_map('floatval', $employee['other_hours']['rtt_hours'])) }}
                        </td>
                    </tr>
                @endforeach
                <!-- Ligne de cumul des heures pour tous les employés -->
                <tr class="text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="row" class="px-6 py-1 font-bold text-gray-900 dark:text-white text-sm">
                        Cumul du mois
                    </th>
                    <td class="px-6 py-1 text-md">
                        {{ $totalDayHours }}
                    </td>
                    <td class="px-6 py-1 text-md">
                        {{ $totalNightHours }}
                    </td>
                    <td class="px-6 py-1 text-md">
                        {{ $totalHolidayHours }}
                    </td>
                    <td class="px-6 py-1 text-md">
                        {{ $totalRTTHours }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

<!-- Script pour la gestion de la navigation entre les mois et Handsontable -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var project_id = document.body.getAttribute('data-project-id') !== 'null' ? parseInt(document.body.getAttribute('data-project-id')) : null;
        var projectCode = document.body.getAttribute('data-project-code') !== 'null' ? document.body.getAttribute('data-project-code') : null;
        var projectBusiness = document.body.getAttribute('data-project-business') !== 'null' ? document.body.getAttribute('data-project-business') : null;
        var month = document.body.getAttribute('data-month') !== 'null' ? parseInt(document.body.getAttribute('data-month')) : null;
        var year = document.body.getAttribute('data-year') !== 'null' ? parseInt(document.body.getAttribute('data-year')) : null;
        var employeeData = @json($employeeData);
        const months = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        // Mise à jour du titre
        if (month && year && projectCode && projectBusiness) {
            document.getElementById('title').innerHTML = `${projectCode} - ${projectBusiness} - ${months[month - 1]} ${year}`;
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
            colHeaders: ['id employé chantier', 'id employé', 'Employé', ...Array.from({ length: daysInMonth }, (_, i) => i + 1)],
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
                if (col >= 3) { // Assurer que nous sommes dans les colonnes des jours
                    cellProperties.renderer = function (instance, td, row, col, prop, value) {
                        Handsontable.renderers.TextRenderer.apply(this, arguments);

                        // Convertir la valeur en nombre
                        const numericValue = parseFloat(value);

                        // Récupérer le type d'heure actuel
                        const hourType = document.querySelector('form button[name="hour_type"].bg-green-500, form button[name="hour_type"].bg-purple-500, form button[name="hour_type"].bg-yellow-500, form button[name="hour_type"].bg-cyan-500').value;

                        // Vérifiez la valeur et appliquez la couleur en conséquence
                        if (isNaN(numericValue)) {
                            td.style.backgroundColor = ''; // Couleur par défaut si la valeur n'est pas un nombre
                        } else if (numericValue === 0) {
                            td.style.backgroundColor = '#ffcccc'; // Rouge pour la valeur 0
                        } else if (numericValue >= 1 && numericValue <= 12) {
                            if (hourType === 'day_hours') {
                                td.style.backgroundColor = '#ccffcc'; // Vert clair pour day_hours
                            } else if (hourType === 'night_hours') {
                                td.style.backgroundColor = '#e6ccff'; // Violet clair pour night_hours
                            } else if (hourType === 'holiday_hours') {
                                td.style.backgroundColor = '#ffffcc'; // Jaune clair pour holiday_hours
                            } else if (hourType === 'rtt_hours') {
                                td.style.backgroundColor = '#ccffff'; // Cyan clair pour rtt_hours
                            }
                        } else {
                            td.style.backgroundColor = ''; // Couleur par défaut pour les autres valeurs
                        }

                        // Ajouter la classe 'weekend' si la colonne correspond à un weekend
                        if (weekends.includes(col)) {
                            td.classList.add('weekend');
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

            const formattedData = data.map(row => {
                const days = row.slice(3).map((day, index) => {
                    const value = day !== null && day !== undefined && day.toString().trim() !== '' ? parseFloat(day) : null;

                    if (value !== null) {
                        if (isNaN(value) || value < 0 || value > 7.4) {
                            validationError = true;
                        } else {
                            hasValidHours = true;
                        }
                    } else {
                        // Si la cellule est vide, préparer une suppression
                        deletedTimeTrackings.push({
                            employee_id: row[1], // ID employé
                            project_id: project_id,
                            date: new Date(year, month - 1, index + 1).toISOString().split('T')[0], // Date du jour concerné
                        });
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
                showMessage('Les heures doivent être des nombres compris entre 0 et 7.4 !', 'error');
                return;
            }

            if (!hasValidHours && deletedTimeTrackings.length === 0) {
                showMessage('Erreur : Aucune heure n\'a été saisie.', 'error');
                return;
            }

            // Envoyer les données si tout est valide, y compris les suppressions
            fetch('{{ route('pointage.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    data: formattedData,
                    deletedTimeTrackings: deletedTimeTrackings,
                    hour_type: document.querySelector('form button[name="hour_type"].bg-green-500, form button[name="hour_type"].bg-purple-500, form button[name="hour_type"].bg-yellow-500, form button[name="hour_type"].bg-cyan-500').value
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('Données sauvegardées avec succès!', 'success');
                        deletedTimeTrackings = []; // Réinitialiser les suppressions après succès
                    } else {
                        showMessage('Erreur lors de la sauvegarde des données : ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    showMessage('Erreur de requête : ' + error.message, 'error');
                });
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
