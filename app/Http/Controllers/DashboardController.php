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
        // Récupérer tous les projets non archivés avec leurs timeTrackings
        $projects = Project::with('timeTrackings')
            ->orderBy('business')
            ->where('archived', false)
            ->get();

        // Préparer les données de coûts pour le graphique
        $costData = [];
        $hourData = [];
        $filteredProjects = $projects->filter(function ($project) {
            return $project->getHoursThisMonth() > 0;
        });

        foreach ($projects as $project) {
            // Calculer le coût du projet pour le mois en cours
            $monthlyCost = $project->calculateMonthlyCost();
            // Calculer le coût total du projet depuis le début
            $totalCost = $project->calculateTotalCost();

            // Ajouter les coûts au tableau des coûts uniquement s'ils sont supérieurs à 0
            if ($monthlyCost > 0) {
                $costData[] = [
                    'project_name' => $project->business,
                    'monthly_cost' => $monthlyCost,
                    'total_cost' => $totalCost,
                ];
            }

            // Ajouter les heures au tableau des heures si supérieur à 0
            if ($project->getHoursThisMonth() > 0) {
                $hourData[] = [
                    'project_name' => $project->business,
                    'hours' => $project->getHoursThisMonth(),
                ];
            }
        }

        // Passer les données des coûts et des heures à la vue
        return view('dashboard', compact('projects', 'costData', 'hourData', 'filteredProjects'));
    }

    public function showProject(): View
    {
        $projects = Project::with('timeTrackings')
            ->orderBy('business')
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

    public function getProjectData(Request $request)
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
            'totalEmployeesCount' => $totalEmployeesCount
        ]);
    }
}
