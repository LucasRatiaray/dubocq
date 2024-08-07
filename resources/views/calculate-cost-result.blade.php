<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coût - résultat') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Cost Calculation Result</h1>
        <p class="mb-2"><strong>Employee:</strong> {{ $employeeName }}</p>
        <p class="mb-2"><strong>Project:</strong> {{ $projectName }}</p>
        <p class="mb-2"><strong>Zone:</strong> {{ $zoneName }}</p>
        <p class="mb-2"><strong>Month:</strong> {{ \Carbon\Carbon::create()->month(intval($month))->format('F') }}</p>
        <p class="mb-2"><strong>Year:</strong> {{ $year }}</p>
        <p class="mb-2"><strong>Total Hours:</strong> {{ $totalHours }}</p>
        <p class="mb-2"><strong>Cost per Hour:</strong> {{ $costPerHour }}</p>
        <p class="mb-2"><strong>Monthly Cost:</strong> {{ $monthlyCost }}</p>
        <a href="{{ route('calculate-cost.form') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Back to Form</a>
    </div>
</x-app-layout>
