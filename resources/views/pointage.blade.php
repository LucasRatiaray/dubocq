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
    >

    <x-pointage.form :projects="$projects"/>

    @if (isset($employeeData))
        <x-pointage.table :project="$project" :month="$month" :year="$year" :employeeData="$employeeData" :hourType="$hourType" :allEmployees="$allEmployees"/>
    @endif

    <div id="message-container" role="alert"></div>

    </body>
</x-app-layout>
