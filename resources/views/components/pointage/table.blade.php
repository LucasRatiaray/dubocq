<div class="mx-auto w-screen flex justify-center">
    <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-400" style="width: 92vw;">
        <div>
            <h1 id="title" class="text-2xl font-bold flex justify-center border rounded py-6 bg-gray-100"></h1>
        </div>

        <div class="mt-4 flex justify-center bg-white">
            <form action="{{ route('pointage.show') }}" method="GET">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="month" value="{{ $month }}">
                <input type="hidden" name="year" value="{{ $year }}">

                <div class="flex justify-center gap-4 p-2 bg-gray-100 border rounded">
                    <button type="submit" name="hour_type" value="day_hours" class="border bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-green-500 hover:text-white {{ $hourType === 'day_hours' ? 'bg-green-500 text-white' : '' }}">Jour</button>
                    <button type="submit" name="hour_type" value="night_hours" class="border bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-purple-500 hover:text-white {{ $hourType === 'night_hours' ? 'bg-purple-500 text-white' : '' }}">Nuit</button>
                    <button type="submit" name="hour_type" value="holiday_hours" class="border bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-yellow-500 hover:text-white {{ $hourType === 'holiday_hours' ? 'bg-yellow-500 text-white' : '' }}">Férié</button>
                    <button type="submit" name="hour_type" value="rtt_hours" class="border bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-cyan-500 hover:text-white {{ $hourType === 'rtt_hours' ? 'bg-cyan-500 text-white' : '' }}">RTT</button>
                </div>
            </form>
        </div>

        <div id="handsontable" class="w-full h-full mt-5"></div>

        <div class="mt-4 flex justify-between">
            <form class="flex items-center gap-4" action="{{ route('pointage.add', ['id' => $project->id]) }}" method="POST">
                @csrf
                <div class="flex">
                    <label for="employee" class="sr-only">Choisir un employé</label>
                    <select name="employee_id" id="employee" class="w-auto bg-gray-100 border border-gray-300 text-gray-900 font-bold text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500">
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
                    <button type="submit" class="bg-gray-100 hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-cyan-500 hover:text-white border border-gray-300">Ajouter un employé</button>
                </div>
            </form>
            <button id="save" class="bg-gray-100 hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-cyan-500 hover:text-white border border-gray-300">Sauvegarder</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
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

        // Condition pour afficher le titre
        if (month && year && projectCode && projectBusiness) {
            document.getElementById('title').innerHTML = `${projectCode} - ${projectBusiness} - ${months[month - 1]} ${year}`;
        }

        // Fonction pour obtenir les jours du mois
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
                    readOnly: false,
                    validator: numericValidator // Utiliser un validateur personnalisé pour les colonnes numériques
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

        // Fonction de validation personnalisée pour les valeurs numériques
        function numericValidator(value, callback) {
            if (value === null || value === '') {
                callback(true); // Valide si la cellule est vide
            } else {
                callback(!isNaN(parseFloat(value)) && isFinite(value)); // Valide uniquement si la valeur est un nombre
            }
        }

        // Fonction pour afficher un message d'erreur ou de succès
        function showMessage(message, type) {
            const messageContainer = document.getElementById('message-container');
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
            messageContainer.className = `custom-alert fixed-message ${alertClass}`;
            messageContainer.innerHTML = `<span class="font-medium">${message}</span>`;
            setTimeout(() => {
                messageContainer.innerHTML = '';
            }, 3000);
        }

        // Fonction pour envoyer les données au serveur
        document.getElementById('save').addEventListener('click', function() {
            const data = hot.getData();
            const formattedData = data.map(row => {
                return {
                    employee_project_id: parseInt(row[0]),
                    employee_id: parseInt(row[1]),
                    project_id: project_id,
                    month: month,
                    year: year,
                    days: row.slice(3).map(day => {
                        return day !== null && day !== undefined && day.toString().trim() !== '' ? parseFloat(day) : null;
                    })
                };
            });

            fetch('{{ route('pointage.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    data: formattedData,
                    hour_type: document.querySelector('form button[name="hour_type"].bg-green-500, form button[name="hour_type"].bg-purple-500, form button[name="hour_type"].bg-yellow-500, form button[name="hour_type"].bg-cyan-500').value // Récupère le type d'heures sélectionné
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showMessage('Données sauvegardées avec succès!', 'success');
                    } else {
                        showMessage('Erreur lors de la sauvegarde des données : ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    showMessage('Erreur de requête : ' + error.message, 'error');
                });
        });
    });
</script>
