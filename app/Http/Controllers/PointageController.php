<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\TimeTracking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;

class PointageController extends Controller
{
    public function index(): View
    {
        $projects = Project::all();
        return view('pointage', compact('projects'));
    }

    private function getAvailableEmployees($project_id): Collection
    {
        return Employee::whereDoesntHave('projects', function ($query) use ($project_id) {
            $query->where('project_id', $project_id);
        })->orderBy('last_name')->get();
    }

    public function show(Request $request): View
    {
        $projects = Project::all();

        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900|max:2099'
        ]);

        $project = Project::findOrFail($request->project_id);
        $month = $request->input('month');
        $year = $request->input('year');
        $hourType = $request->input('hour_type', 'day_hours'); // Par défaut, jour
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Récupérer les employés associés au projet
        $employees = Employee::join('employee_projects', 'employees.id', '=', 'employee_projects.employee_id')
            ->where('employee_projects.project_id', $project->id)
            ->get(['employees.*', 'employee_projects.id as employee_project_id']);

        // Récupérer les employés disponibles pour ce projet
        $allEmployees = Employee::whereDoesntHave('projects', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->orderBy('last_name')->get();

        // Récupérer les heures de travail
        $timeTrackings = TimeTracking::where('project_id', $project->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $employeeData = [];
        foreach ($employees as $employee) {
            $days = array_fill(0, $daysInMonth, '');
            $otherHours = ['night_hours' => [], 'holiday_hours' => [], 'rtt_hours' => []];

            foreach ($timeTrackings as $timeTracking) {
                if ($timeTracking->employee_id == $employee->id) {
                    $day = (int) Carbon::parse($timeTracking->date)->format('d');
                    $days[$day - 1] = $timeTracking->$hourType;  // Utilisation du type d'heures dynamique

                    // Stocker les autres types d'heures
                    if ($hourType !== 'night_hours' && $timeTracking->night_hours) {
                        $otherHours['night_hours'][$day - 1] = $timeTracking->night_hours;
                    }
                    if ($hourType !== 'holiday_hours' && $timeTracking->holiday_hours) {
                        $otherHours['holiday_hours'][$day - 1] = $timeTracking->holiday_hours;
                    }
                    if ($hourType !== 'rtt_hours' && $timeTracking->rtt_hours) {
                        $otherHours['rtt_hours'][$day - 1] = $timeTracking->rtt_hours;
                    }
                }
            }

            $employeeData[] = [
                'employee_project_id' => $employee->employee_project_id,
                'employee_id' => $employee->id,
                'full_name' => $employee->last_name . ' ' . $employee->first_name,
                'days' => $days,
                'other_hours' => $otherHours
            ];
        }

        return view('pointage', compact('projects', 'project', 'month', 'year', 'employeeData', 'hourType', 'allEmployees'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'data' => 'required|array',
            'hour_type' => 'required|string|in:day_hours,night_hours,holiday_hours,rtt_hours',
        ]);

        $data = $request->input('data');
        $hourType = $request->input('hour_type');

        foreach ($data as $employee) {
            $employee_id = $employee['employee_id'];
            $project_id = $employee['project_id'];
            $month = $employee['month'];
            $year = $employee['year'];

            foreach ($employee['days'] as $day => $hours) {
                if ($hours !== null) {
                    // Validation des heures : elles doivent être comprises entre 0 et 7.4
                    if (!is_numeric($hours) || $hours < 0 || $hours > 7.4) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Les heures doivent être des nombres compris entre 0 et 7.4 !',
                        ], 400);
                    }

                    $date = Carbon::createFromDate($year, $month, $day + 1)->format('Y-m-d');

                    // Récupérer ou créer l'enregistrement de suivi de temps
                    $timeTracking = TimeTracking::firstOrNew([
                        'project_id' => $project_id,
                        'employee_id' => $employee_id,
                        'date' => $date
                    ]);

                    // Mettre à jour les heures spécifiques en fonction du type
                    $timeTracking->{$hourType} = $hours;

                    // Sauvegarder les modifications
                    $timeTracking->save();
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Données sauvegardées avec succès!']);
    }

    public function addEmployeeToProject(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900|max:2099'
        ]);

        $project = Project::findOrFail($id);
        $employee = Employee::findOrFail($request->employee_id);

        $employee->projects()->attach($project->id);

        return redirect()->route('pointage.show', [
            'project_id' => $project->id,
            'month' => $request->month,
            'year' => $request->year,
            'hour_type' => 'day_hours' // Par défaut sur Jour
        ])->with('success', 'Employé ajouté au projet avec succès!');
    }
}
