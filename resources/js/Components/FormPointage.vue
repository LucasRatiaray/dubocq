<template>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form class="flex justify-center items-center gap-4" @submit.prevent="submitForm">
            <div class="flex gap-1">
                <label for="project_id" class="sr-only">Choisir un projet</label>
                <select v-model="project_id" id="project_id" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled selected>Choisir un projet</option>
                    <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
                </select>
                <label for="month" class="sr-only">Choisir un mois</label>
                <select v-model="month" id="month" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option v-for="(month, key) in frenchMonth" :key="key" :value="key">{{ month }}</option>
                </select>
                <label for="year" class="sr-only">Choisir une année</label>
                <select v-model="year" id="year" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-gray-500 hover:bg-custom-900 text-white font-bold py-2 px-4 rounded">Afficher le projet</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    projects: Array,
});

const project_id = ref('');
const month = ref(1);
const year = ref(new Date().getFullYear());

const frenchMonth = {
    1: 'Janvier',
    2: 'Février',
    3: 'Mars',
    4: 'Avril',
    5: 'Mai',
    6: 'Juin',
    7: 'Juillet',
    8: 'Août',
    9: 'Septembre',
    10: 'Octobre',
    11: 'Novembre',
    12: 'Décembre'
};

const years = [2024, 2023, 2022, 2021, 2020];

const submitForm = () => {
    Inertia.post(route('pointage.show', project_id.value), {
        month: month.value,
        year: year.value,
    });
};
</script>

<style scoped>
</style>
