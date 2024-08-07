<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coût') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Calculate Monthly Cost</h1>
        <form action="{{ route('calculate-cost.calculate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id" class="form-control">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->firstName }} {{ $employee->lastName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="project_id">Project:</label>
                <select name="project_id" id="project_id" class="form-control">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->business }} ({{ $project->city }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="month">Month:</label>
                <select name="month" id="month" class="form-control" required>
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
            <div class="form-group">
                <label for="year">Year:</label>
                <select name="year" id="year" class="form-control" required>
                    @for ($i = 2020; $i <= date('Y'); $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>

</x-app-layout>
