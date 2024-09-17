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
        data-project-zone="{{ $project->zone->name ?? 'null' }}"
        data-month="{{ $month ?? 'null' }}"
        data-year="{{ $year ?? 'null'}}"
    >

    <x-pointage.form :projects="$projects"/>

    @if (isset($employeeData))
        <x-pointage.table :project="$project" :month="$month" :year="$year" :employeeData="$employeeData" :hourType="$hourType" :allEmployees="$allEmployees" :nonWorkingDays="$nonWorkingDays"/>
    @endif

    <!-- Conteneur pour les messages -->
    <div id="message-container-success" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
        <span class="font-medium">Succès!</span> <span id="success-message-text">Success message here</span>
    </div>
    <div id="message-container-error" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
        <span class="font-medium">Attention!</span> <span id="error-message-text">Error message here</span>
    </div>

    </body>
</x-app-layout>
