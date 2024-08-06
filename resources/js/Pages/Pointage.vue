<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormComponent from '@/Components/FormPointage.vue';
import TableComponent from '@/Components/TablePointage.vue';

const props = defineProps({
    projects: Array,
    project: Object,
    month: Number,
    year: Number,
    employeeData: Array,
    allemployes: Array,
});

const monthNames = [
    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
];
</script>

<template>
    <Head title="Pointage" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pointage</h2>
        </template>

        <div class="p-6">
            <FormComponent :projects="props.projects" />

            <TableComponent
                v-if="props.project && props.project.name && props.project.city && props.month && props.year"
                :title="'Chantier : ' + (props.project.name || '') + ' - Ville : ' + (props.project.city || '') + ' - Mois : ' + monthNames[props.month - 1] + ' - Année : ' + props.year"
                :employes="props.allemployes"
                :employeeData="props.employeeData"
                :year="props.year"
                :month="props.month"
                :chantierId="props.project.id"
            />
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
