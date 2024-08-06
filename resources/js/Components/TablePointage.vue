<template>
    <div class="mx-auto w-screen flex justify-center">
        <div class="bg-white shadow-md rounded-lg p-6" style="width: 92vw;">
            <h1 id="title" class="text-2xl font-bold mb-4">{{ title }}</h1>

            <form class="py-6 flex items-center gap-4">
                <div class="flex">
                    <label for="employee" class="sr-only">Choisir un employé</label>
                    <select id="employee" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Choisir un employé</option>
                        <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-gray-500 hover:bg-custom-900 text-white font-bold py-2 px-4 rounded">Ajouter un employé</button>
                </div>
            </form>

            <div id="handsontable" class="w-full h-full"></div>
            <button @click="saveData" class="mt-4 bg-gray-500 hover:bg-custom-900 text-white font-bold py-2 px-4 rounded">Sauvegarder</button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    title: String,
    employees: Array,
    employeeData: Array,
    year: Number,
    month: Number,
    projectId: Number,
});

onMounted(() => {
    // Récupérer les données de props et les configurer pour Handsontable
    const handsontableConfig = {
        data: props.employeeData,
        colHeaders: ['ID Employé chantier', 'ID Employé', 'Employé', ...Array.from({ length: getDaysInMonth(props.year, props.month) }, (_, i) => i + 1)],
        columns: [
            { data: 'employe_chantier_id', readOnly: true },
            { data: 'employe_id', readOnly: true },
            { data: 'full_name', readOnly: true, sortIndicator: false },
            ...Array.from({ length: getDaysInMonth(props.year, props.month) }, (_, i) => ({
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
    };

    const container = document.getElementById('handsontable');
    const hot = new Handsontable(container, handsontableConfig);
});

function getDaysInMonth(year, month) {
    return new Date(year, month, 0).getDate();
}

function saveData() {
    // Implémenter la logique de sauvegarde des données ici
}
</script>

<style scoped>

</style>

