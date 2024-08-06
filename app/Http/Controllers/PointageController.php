<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\TimeTracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PointageController extends Controller
{
    public function index(): View
    {
        $projects = Project::all();

        return view('pointage', compact('projects'));
    }

    public function show(Request $request): View
    {
        $request->validate([
            'projectId' => 'required|exists:projects,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900|max:2099'
        ]);

        $project = Project::findOrFail($request->input('projectId'));
        $month = $request->input('month');
        $year = $request->input('year');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Mise à jour de la requête pour utiliser les bons noms de colonnes
        $employees = Employee::join('employee_projects', 'employees.id', '=', 'employee_projects.employeeId')
            ->where('employee_projects.projectId', $project->id)
            ->get(['employees.*', 'employee_projects.id as employee_projectId']);

        $allEmployees = $this->getAvailableEmployees($project->id);

        $timeTrackings = TimeTracking::where('projectId', $project->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $employeeData = [];
        foreach ($employees as $employee) {
            $days = array_fill(0, $daysInMonth, '');

            foreach ($timeTrackings as $timeTracking) {
                if ($timeTracking->employeeId == $employee->id) {  // Vérifiez également que la colonne dans TimeTracking est correcte
                    $day = (int) Carbon::parse($timeTracking->date)->format('d');
                    $days[$day - 1] = $timeTracking->hours;
                }
            }

            $employeeData[] = [
                'employee_projectId' => $employee->employee_projectId,
                'employeeId' => $employee->id,
                'fullName' => $employee->firstname . ' ' . $employee->lastname,
                'days' => $days,
            ];
        }

        $projects = Project::all();

        return view('pointage', compact('project', 'month', 'year', 'employeeData', 'allEmployees', 'projects'));
    }

    private function getAvailableEmployees($projectId)
    {
        return Employee::whereDoesntHave('projects', function ($query) use ($projectId) {
            $query->where('projectId', $projectId);
        })->get();
    }
}
