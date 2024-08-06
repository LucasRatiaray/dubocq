<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pointage') }}
        </h2>
    </x-slot>

    <body
        data-year="{{ $year ?? 'null' }}"
        data-month="{{ $month ?? 'null' }}"
        data-employee-data="{{ json_encode($employeeData ?? []) }}"
        data-project-id="{{ $project->id ?? 'null' }}"
        data-project-business="{{ $project->business ?? '' }}"
        data-project-city="{{ $project->city ?? '' }}"
    >

    <x-pointage.form :projects="$projects"/>

    @isset($employeeData)
        <x-pointage.table :project="$project" :month="$month" :year="$year" :employeeData="$employeeData" :allEmployees="$allEmployees" />
    @endisset

    <script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log("DOM fully loaded and parsed");

            var year = document.body.getAttribute('data-year') !== 'null' ? parseInt(document.body.getAttribute('data-year')) : null;
            var month = document.body.getAttribute('data-month') !== 'null' ? parseInt(document.body.getAttribute('data-month')) : null;
            var employeeData = JSON.parse(document.body.getAttribute('data-employee-data') || '[]');
            var projectId = document.body.getAttribute('data-project-id') !== 'null' ? document.body.getAttribute('data-project-id') : null;

            console.log({ year, month, employeeData, projectId });

            // Liste des noms de mois en français
            const monthNames = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];

            // Fonction pour obtenir les jours du mois
            function getDaysInMonth(year, month) {
                return new Date(year, month, 0).getDate();
            }

            // Fonction pour vérifier si une date est un weekend
            function isWeekend(date) {
                const day = date.getDay();
                return day === 0 || day === 6;
            }

            // Affichage du titre avec le mois en français
            if (year && month) {
                document.getElementById('title').innerHTML = `Projet : ${document.body.getAttribute('data-project-business')} - Ville : ${document.body.getAttribute('data-project-city')} - Mois : ${monthNames[month - 1]} - Année : ${year}`;
            }

            var container = document.getElementById('handsontable');
            if (!container) {
                console.error("Element with id 'handsontable' not found.");
                return;
            }

            var daysInMonth = year && month ? getDaysInMonth(year, month) : 0;
            var weekends = year && month ? Array.from({ length: daysInMonth }, (_, i) => {
                let date = new Date(year, month - 1, i + 1);
                return isWeekend(date) ? i + 3 : null; // Ajouter 3 pour correspondre à l'index de la colonne dans Handsontable
            }).filter(index => index !== null) : [];

            var hot = new Handsontable(container, {
                data: employeeData,
                colHeaders: ['ID Employé Projet', 'ID Employé', 'Employé', ...Array.from({ length: daysInMonth }, (_, i) => i + 1)],
                columns: [
                    { data: 'employee_projectId', readOnly: true },
                    { data: 'employeeId', readOnly: true },
                    { data: 'fullName', readOnly: true, sortIndicator: false },
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

            document.getElementById('save').addEventListener('click', function () {
                const data = hot.getData();
                const formattedData = data.map(row => {
                    return {
                        employee_projectId: parseInt(row[0]),
                        employeeId: parseInt(row[1]),
                        projectId: projectId,
                        month: month,
                        year: year,
                        days: row.slice(3).map(day => {
                            return day !== null && day !== undefined && day.toString().trim() !== '' ? parseFloat(day) : null;
                        })
                    };
                });
                console.log(formattedData);
            });
        });
    </script>
    </body>
</x-app-layout>
