<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function show(Project $project): View
    {
        $totalCost = $project->calculateTotalCost();
        $monthlyCosts = $project->calculateMonthlyCost();
        $monthlyEmployeeCosts = $project->calculateMonthlyEmployeeCosts();

        return view('projects', compact('project', 'totalCost', 'monthlyCosts', 'monthlyEmployeeCosts'));
    }
}
