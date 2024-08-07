<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coût') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Calculate Monthly Cost</h1>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('calculate-cost.calculate') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="employee_id" class="block text-gray-700">Employee:</label>
                <select name="employee_id" id="employee_id" class="w-full border-gray-300 rounded mt-1">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->firstName }} {{ $employee->lastName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="project_id" class="block text-gray-700">Project:</label>
                <select name="project_id" id="project_id" class="w-full border-gray-300 rounded mt-1">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->business }} ({{ $project->city }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="month" class="block text-gray-700">Month:</label>
                <select name="month" id="month" class="w-full border-gray-300 rounded mt-1" required>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="year" class="block text-gray-700">Year:</label>
                <select name="year" id="year" class="w-full border-gray-300 rounded mt-1" required>
                    @for ($i = 2020; $i <= date('Y'); $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Calculate</button>
        </form>
    </div>
</x-app-layout>
