<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function show(): View
    {
        // Obtenir le mois et l'année actuels
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Récupérer les projets non archivés qui ont des timeTrackings durant le mois en cours
        $projects = Project::with(['timeTrackingsCurrentMonth' => function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear);
        }])
            ->whereHas('timeTrackings', function($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('date', $currentMonth)
                    ->whereYear('date', $currentYear);
            })
            ->orderBy('code')
            ->where('archived', false)
            ->get();

        // Préparer les données de coûts pour le graphique
        $costData = [];
        $hourData = [];

        foreach ($projects as $project) {
            // Calculer le coût du projet pour le mois en cours
            $monthlyCost = $project->calculateMonthlyCost();
            // Calculer le coût total du projet depuis le début
            $totalCost = $project->calculateTotalCost();

            // Ajouter les coûts au tableau des coûts
            $costData[] = [
                'project_name' => $project->business,
                'monthly_cost' => $monthlyCost,
                'total_cost' => $totalCost,
            ];

            // Ajouter les heures au tableau des heures
            $hourData[] = [
                'project_name' => $project->business,
                'hours' => $project->getHoursThisMonth(),
            ];
        }

        // Passer les données des coûts et des heures à la vue
        return view('dashboard', compact('projects', 'costData', 'hourData'));
    }

    public function showProject(): View
    {
        $projects = Project::with('timeTrackings')
            ->orderBy('code')
            ->where('archived', false)
            ->get();

        $employeeCosts = [];

        // Boucle sur chaque projet
        foreach ($projects as $project) {
            foreach ($project->employees as $employee) {
                $timeTrackings = $employee->timeTrackings()->where('project_id', $project->id)->get();
                $cost = $employee->getEmployeeCost($timeTrackings);

                $employeeCosts[] = [
                    'project_name' => $project->business,
                    'employee_name' => $employee->first_name . ' ' . $employee->last_name,
                    'hours' => $employee->getTotalHours($timeTrackings),
                    'cost' => $cost
                ];
            }
        }

        return view('components.dashboard.project', compact('projects', 'employeeCosts'));
    }

    public function showEmployee(): View
    {
        $employees = Employee::with('timeTrackings')
            ->orderBy('last_name')
            ->where('archived', false)
            ->get();

        $projectTypes = Project::select('type')->distinct()->pluck('type');

        return view('components.dashboard.employee', compact('employees', 'projectTypes'));
    }

    public function getProjectData(Request $request): JsonResponse
    {
        $projectId = $request->input('project_id');
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
        $employeeStatus = $request->input('employee_status');

        // Récupérer le projet avec les employés filtrés par statut
        $project = Project::with(['timeTrackings', 'employees' => function ($query) use ($employeeStatus) {
            if (!empty($employeeStatus)) {
                $query->where('status', $employeeStatus);
            }
        }])->findOrFail($projectId);

        $employeeCosts = [];

        // Calculer les heures et coûts pour chaque employé du projet
        foreach ($project->employees as $employee) {
            $timeTrackingsThisMonth = $employee->timeTrackings()
                ->where('project_id', $project->id)
                ->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear)
                ->get();

            $monthlyCost = $employee->getEmployeeCost($timeTrackingsThisMonth);
            $monthlyHours = $employee->getTotalHours($timeTrackingsThisMonth);

            $timeTrackingsAllTime = $employee->timeTrackings()->where('project_id', $project->id)->get();
            $totalCost = $employee->getEmployeeCost($timeTrackingsAllTime);
            $totalHours = $employee->getTotalHours($timeTrackingsAllTime);

            $employeeCosts[] = [
                'employee_name' => $employee->first_name . ' ' . $employee->last_name,
                'monthly_hours' => $monthlyHours,
                'monthly_cost' => $monthlyCost,
                'total_hours' => $totalHours,
                'total_cost' => $totalCost,
                'employee_status' => $employee->status
            ];
        }

        // Calculer les totaux
        $totalMonthlyHours = collect($employeeCosts)->sum('monthly_hours');
        $totalMonthlyCost = collect($employeeCosts)->sum('monthly_cost');
        $totalHours = collect($employeeCosts)->sum('total_hours');
        $totalCost = collect($employeeCosts)->sum('total_cost');

        // Retourner les données au format JSON
        return response()->json([
            'employeeCosts' => $employeeCosts,
            'projectType' => $project->type,
            'employeeStatus' => $employeeStatus,
            'totalMonthlyHours' => $totalMonthlyHours,
            'totalMonthlyCost' => $totalMonthlyCost,
            'totalHours' => $totalHours,
            'totalCost' => $totalCost,
        ]);
    }

    public function getEmployeeData(Request $request): JsonResponse
    {
        $employeeId = $request->input('employee_id');
        $selectedMonth = $request->input('month'); // Récupérer le mois sélectionné
        $selectedYear = $request->input('year'); // Récupérer l'année sélectionnée
        $projectType = $request->input('project_type'); // Récupérer le type de chantier (si fourni)

        // Récupérer l'employé avec ses timeTrackings et les projets associés
        $employee = Employee::with(['timeTrackings' => function ($query) use ($selectedMonth, $selectedYear) {
            $query->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear);
        }, 'projects'])->findOrFail($employeeId);

        $projectData = [];

        // Parcourir chaque projet sur lequel l'employé a travaillé
        foreach ($employee->projects as $project) {
            // Appliquer le filtre de type de chantier si spécifié
            if (!empty($projectType) && $project->type !== $projectType) {
                continue; // Ignorer ce projet si le type ne correspond pas
            }

            // Récupérer les timeTrackings pour ce projet
            $timeTrackings = $employee->timeTrackings->where('project_id', $project->id);

            // Calculer les heures de jour, de nuit et le coût total pour ce projet
            $dayHours = $timeTrackings->sum('day_hours');
            $nightHours = $timeTrackings->sum('night_hours');
            $totalHours = $dayHours + $nightHours;

            // Calculer le coût basé sur les heures travaillées et le tarif de l'employé pour ce projet
            $cost = $employee->getEmployeeCost($timeTrackings);

            // Ajouter les données pour ce projet
            $projectData[] = [
                'project_name' => $project->business,
                'project_city' => $project->city,
                'project_code' => $project->code,
                'day_hours' => $dayHours,
                'night_hours' => $nightHours,
                'total_hours' => $totalHours,
                'cost' => $cost
            ];
        }

        // Calculer les totaux des heures et des coûts
        $totalDayHours = array_sum(array_column($projectData, 'day_hours'));
        $totalNightHours = array_sum(array_column($projectData, 'night_hours'));
        $totalCost = array_sum(array_column($projectData, 'cost'));

        // Retourner les données au format JSON
        return response()->json([
            'projectData' => $projectData,
            'totalDayHours' => $totalDayHours,
            'totalNightHours' => $totalNightHours,
            'totalCost' => $totalCost,
            'employeeStatus' => $employee->status
        ]);
    }

    public function getEmployeeProjectTypeData(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
        $projectType = $request->input('project_type');

        // Récupérer l'employé
        $employee = Employee::findOrFail($employeeId);

        // Récupérer les projets de l'employé du type sélectionné si spécifié
        $projects = $employee->projects();

        if (!empty($projectType)) {
            $projects->where('type', $projectType);
        }

        $projects = $projects->get();

        $projectData = [];

        foreach ($projects as $project) {
            // Heures du mois pour ce projet
            $timeTrackingsMonth = $employee->timeTrackings()
                ->where('project_id', $project->id)
                ->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear)
                ->get();

            $totalHoursMonth = $timeTrackingsMonth->sum('day_hours') + $timeTrackingsMonth->sum('night_hours');

            // Heures de l'année pour ce projet
            $timeTrackingsYear = $employee->timeTrackings()
                ->where('project_id', $project->id)
                ->whereYear('date', $selectedYear)
                ->get();

            $totalHoursYear = $timeTrackingsYear->sum('day_hours') + $timeTrackingsYear->sum('night_hours');

            // Calcul du coût total pour l'année pour ce projet
            $totalCostYear = $employee->getEmployeeCost($timeTrackingsYear, $project->zone_id);

            // Ajouter les données pour ce projet seulement si l'employé a travaillé dessus
            if ($totalHoursMonth > 0 || $totalHoursYear > 0) {
                $projectData[] = [
                    'project_code' => $project->code,
                    'project_name' => $project->business,
                    'project_city' => $project->city,
                    'total_hours_month' => $totalHoursMonth,
                    'total_hours_year' => $totalHoursYear,
                    'total_cost_year' => $totalCostYear,
                ];
            }
        }

        return response()->json([
            'projectData' => $projectData
        ]);
    }
}
