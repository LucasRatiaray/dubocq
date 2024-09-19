<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
        return view('components.dashboard.project');
    }
}
