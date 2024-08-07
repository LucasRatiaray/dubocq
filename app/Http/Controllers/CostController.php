<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\TimeTracking;
use App\Models\HourlyRate;
use App\Models\Hourly70Rate;
use App\Models\Basket;
use App\Models\Zone;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function showForm()
    {
        $employees = Employee::all();
        $projects = Project::all();

        return view('calculate-cost', compact('employees', 'projects'));
    }

    public function calculateMonthlyCost(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $projectId = $request->input('project_id');
        $month = $request->input('month');
        $year = $request->input('year');

        // Récupérer les heures travaillées par l'employé sur le chantier pour le mois spécifié
        $timeTrackings = TimeTracking::where('employee_id', $employeeId)
            ->where('project_id', $projectId)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $totalHours = $timeTrackings->sum('hours');

        // Récupérer les taux horaires
        $hourly70Rate = Hourly70Rate::where('employee_id', $employeeId)->first();
        $hourlyRate = HourlyRate::where('employee_id', $employeeId)->first();

        if (!$hourly70Rate || !$hourlyRate) {
            return back()->withErrors('Rates not found for the specified employee.');
        }

        // Récupérer le projet et la zone associée
        $project = Project::find($projectId);
        $zone = $this->getZoneByKm($project->km);

        if (!$zone) {
            return back()->withErrors('Zone not found for the specified project.');
        }

        // Récupérer le panier pour la zone
        $basket = Basket::where('zone_id', $zone->id)->first();

        if (!$basket) {
            return back()->withErrors('Basket not found for the specified zone.');
        }

        // Calculer le coût horaire total
        $costPerHour = $hourly70Rate->rate + $basket->basket37h + $hourlyRate->rate;

        // Calculer le coût mensuel total
        $monthlyCost = $totalHours * $costPerHour;

        return view('calculate-cost-result', compact('employeeId', 'projectId', 'month', 'year', 'totalHours', 'costPerHour', 'monthlyCost'));
    }

    private function getZoneByKm($km): ?Zone
    {
        return Zone::where('kmRange', '>=', $km)->orderBy('kmRange', 'asc')->first();
    }
}
