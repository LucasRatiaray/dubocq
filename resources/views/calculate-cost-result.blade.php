<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coût - resultat') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Cost Calculation Result</h1>
        <p><strong>Employee ID:</strong> {{ $employeeId }}</p>
        <p><strong>Project ID:</strong> {{ $projectId }}</p>
        <p><strong>Month:</strong> {{ $month }}</p>
        <p><strong>Year:</strong> {{ $year }}</p>
        <p><strong>Total Hours:</strong> {{ $totalHours }}</p>
        <p><strong>Cost per Hour:</strong> {{ $costPerHour }}</p>
        <p><strong>Monthly Cost:</strong> {{ $monthlyCost }}</p>
        <a href="{{ route('calculate-cost.form') }}" class="btn btn-primary">Back to Form</a>
    </div>

</x-app-layout>
