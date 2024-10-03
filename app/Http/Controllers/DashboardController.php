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
        $projects = Project::with(['timeTrackings' => function ($query) use ($currentMonth, $currentYear) {
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

        return view('components.dashboard.employee', compact('employees'));
    }

    public function getProjectData(Request $request): JsonResponse
    {
        $projectId = $request->input('project_id');
        $selectedMonth = $request->input('month'); // Récupérer le mois sélectionné
        $selectedYear = $request->input('year'); // Récupérer l'année sélectionnée

        // Récupérer le projet sélectionné avec les timeTrackings et les employés
        $project = Project::with('timeTrackings', 'employees')->findOrFail($projectId);

        $employeeCosts = [];

        // Récupérer le nombre total de salariés dans la base de données
        $totalEmployeesCount = Employee::count();

        // Calculer les heures et coûts pour chaque employé du projet
        foreach ($project->employees as $employee) {
            // Récupérer les timeTrackings pour le mois sélectionné
            $timeTrackingsThisMonth = $employee->timeTrackings()
                ->where('project_id', $project->id)
                ->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear)
                ->get();

            $monthlyCost = $employee->getEmployeeCost($timeTrackingsThisMonth);
            $monthlyHours = $employee->getTotalHours($timeTrackingsThisMonth);

            // Récupérer tous les timeTrackings depuis le début
            $timeTrackingsAllTime = $employee->timeTrackings()->where('project_id', $project->id)->get();
            $totalCost = $employee->getEmployeeCost($timeTrackingsAllTime);
            $totalHours = $employee->getTotalHours($timeTrackingsAllTime);

            $employeeCosts[] = [
                'employee_name' => $employee->first_name . ' ' . $employee->last_name,
                'monthly_hours' => $monthlyHours,
                'monthly_cost' => $monthlyCost,
                'total_hours' => $totalHours,
                'total_cost' => $totalCost
            ];
        }

        // Retourner les données au format JSON
        return response()->json([
            'employeeCosts' => $employeeCosts,
            'totalEmployeesCount' => $totalEmployeesCount,
            'projectType' => $project->type
        ]);
    }

    public function getEmployeeData(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $selectedMonth = $request->input('month'); // Récupérer le mois sélectionné
        $selectedYear = $request->input('year'); // Récupérer l'année sélectionnée

        // Récupérer l'employé avec ses timeTrackings et les projets associés
        $employee = Employee::with(['timeTrackings' => function ($query) use ($selectedMonth, $selectedYear) {
            $query->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear);
        }, 'projects'])->findOrFail($employeeId);

        $projectData = [];

        // Parcourir chaque projet sur lequel l'employé a travaillé
        foreach ($employee->projects as $project) {
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

        // Retourner les données au format JSON
        return response()->json([
            'projectData' => $projectData,
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

        // Récupérer les projets de l'employé du type sélectionné
        $projects = $employee->projects()
            ->where('type', $projectType)
            ->get();

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
            $totalCostYear = $employee->getEmployeeCost($timeTrackingsYear);

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
