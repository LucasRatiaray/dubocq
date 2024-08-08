<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pointage') }}
        </h2>
    </x-slot>

    <body
        data-project-id="{{ $project->id ?? 'null' }}"
        data-project-business="{{ $project->business ?? 'null' }}"
        data-project-code="{{ $project->code ?? 'null' }}"
        data-month="{{ $month ?? 'null' }}"
        data-year="{{ $year ?? 'null'}}"
        data-employee-data="{{ json_encode($employeeData ?? []) }}"
    >

    <x-pointage.form :projects="$projects"/>

    @if (isset($employeeData))
        <x-pointage.table :project="$project" :month="$month" :year="$year" :employeeData="$employeeData" :allEmployees="$allEmployees"/>
    @endif

    <div id="message-container" role="alert"></div>

    <script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var project_id = document.body.getAttribute('data-project-id') !== 'null' ? parseInt(document.body.getAttribute('data-project-id')) : null;
            var projectCode = document.body.getAttribute('data-project-code') !== 'null' ? document.body.getAttribute('data-project-code') : null;
            var projectBusiness = document.body.getAttribute('data-project-business') !== 'null' ? document.body.getAttribute('data-project-business') : null;
            var month = document.body.getAttribute('data-month') !== 'null' ? parseInt(document.body.getAttribute('data-month')) : null;
            var year = document.body.getAttribute('data-year') !== 'null' ? parseInt(document.body.getAttribute('data-year')) : null;
            var employeeData = JSON.parse(document.body.getAttribute('data-employee-data'));
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
                    { data: 'full_name', readOnly: true, sortIndicator: false},
                    ...Array.from({ length: daysInMonth }, (_, i) => ({
                        data: `days.${i}`,
                        type: 'numeric',
                        readOnly: false
                    }))
                ],
                rowHeaders: true,
                manualColumnResize: true,
                height: 'auto',
                manualRowResize: true,
                contextMenu: {
                    items: {
                        "row_above": false,
                        "row_below": false,
                        "remove_row": false,
                        "col_left": false,
                        "col_right": false,
                        "remove_col": false,
                        "alignment": false,
                        "copy": false,
                        "cut": false,
                        "paste": false,
                        "undo": false,
                        "redo": false
                    }
                },
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

                            // Vérifiez la valeur et appliquez la couleur en conséquence
                            if (isNaN(numericValue)) {
                                td.style.backgroundColor = ''; // Couleur par défaut si la valeur n'est pas un nombre
                            } else if (numericValue === 0) {
                                td.style.backgroundColor = '#ffcccc'; // Rouge pour la valeur 0
                            } else if (numericValue >= 1 && numericValue <= 12) {
                                td.style.backgroundColor = '#ccffcc'; // Vert clair pour les valeurs entre 1 et 12
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
                    body: JSON.stringify({data: formattedData})
                })
                    .then(response => {
                        console.log(response);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            showMessage('Données sauvegardées avec succès!', 'success');
                        } else {
                            showMessage('Erreur lors de la sauvegarde des données : ' + data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showMessage('Erreur de requête : ' + error.message, 'error');
                    });
                console.log(formattedData);
            });
        });
    </script>

    </body>
</x-app-layout>
