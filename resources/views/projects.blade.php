<div class="container">
    <h1>Projet: {{ $project->business }}</h1>
    <p>Code: {{ $project->code }}</p>
    <p>Ville: {{ $project->city }}</p>
    <p>Adresse: {{ $project->address }}</p>
    <p>Kilomètres: {{ $project->kilometers }} km</p>
    <p>{{ $project->zone->name }}</p>
    <p>Coût total: {{ number_format($totalCost, 2) }} €</p>

    <h2>Coûts Mensuels</h2>
    <ul>
        @foreach ($monthlyCosts as $month => $cost)
            <li>{{ $month }}: {{ number_format($cost, 2) }} €</li>
        @endforeach
    </ul>

    <h2>Détails des coûts mensuels par salarié</h2>
    @foreach ($monthlyEmployeeCosts as $month => $employeeCosts)
        <h3>{{ $month }}</h3>
        <ul>
            @foreach ($employeeCosts as $employeeCost)
                @if ($employeeCost['cost'] != 0)
                <li>{{ $employeeCost['employee']->first_name }} {{ $employeeCost['employee']->last_name }}:
                    {{ number_format($employeeCost['cost'], 2) }} €
                </li>
                @endif
            @endforeach
        </ul>
    @endforeach

    <h2>Salariés</h2>
    <ul>
        @foreach ($project->employeeProjects as $employeeProject)
            <li>{{ $employeeProject->employee->first_name }} {{ $employeeProject->employee->last_name }}:
                {{ number_format($employeeProject->employee->calculateCostForProject($project), 2) }} €
            </li>
        @endforeach
    </ul>
</div>
