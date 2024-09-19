<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\NonWorkingDay;
use App\Models\Project;
use App\Models\TimeTracking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PointageController extends Controller
{
    public function index(): View
    {
        $projects = Project::where('archived', false)
            ->orderBy('business')
            ->get();

        return view('pointage', compact('projects'));
    }

    public function show(Request $request): View
    {
        $projects = Project::where('archived', false)
            ->orderBy('business')
            ->get();

        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900|max:2099'
        ]);

        $project = Project::findOrFail($request->project_id);
        $month = $request->input('month');
        $year = $request->input('year');
        $hourType = $request->input('hour_type', 'day_hours');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Récupérer les jours non travaillés pour le mois et l'année sélectionnés
        $nonWorkingDays = NonWorkingDay::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->pluck('date')
            ->toArray();

        // Récupérer les employés associés au projet
        $employees = Employee::join('employee_projects', 'employees.id', '=', 'employee_projects.employee_id')
            ->where('employee_projects.project_id', $project->id)
            ->orderBy('archived')   // Trier d'abord par statut d'archivage (non archivé en haut)
            ->orderBy('last_name')  // Puis trier par nom de famille (ordre alphabétique)
            ->get(['employees.*', 'employee_projects.id as employee_project_id']);

        // Récupérer les employés disponibles pour ce projet
        $allEmployees = Employee::whereDoesntHave('projects', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->where('archived', false)->orderBy('last_name')->get();

        // Récupérer les heures de travail pour le mois et l'année
        $timeTrackings = TimeTracking::where('project_id', $project->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $employeeData = [];
        foreach ($employees as $employee) {
            $days = $employee->getHoursByDay($timeTrackings, $daysInMonth, $hourType);
            $totalDayHours = $employee->getTotalDayHours($timeTrackings);
            $totalNightHours = $employee->getTotalNightHours($timeTrackings);
            $totalHours = $employee->getTotalHours($timeTrackings);

            $employeeData[] = [
                'employee_project_id' => $employee->employee_project_id,
                'employee_id' => $employee->id,
                'full_name' => $employee->last_name . ' ' . $employee->first_name,
                'days' => $days,
                'total_day_hours' => $totalDayHours,
                'total_night_hours' => $totalNightHours,
                'total_hours' => $totalHours,
                'archived' => $employee->archived,
            ];
        }

        // Transmettre les données à la vue, y compris $allEmployees
        return view('pointage', compact('projects', 'project', 'month', 'year', 'employeeData', 'hourType', 'allEmployees', 'nonWorkingDays'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'data' => 'required|array',
            'hour_type' => 'required|string|in:day_hours,night_hours',
            'deletedTimeTrackings' => 'nullable|array',
        ]);

        $data = $request->input('data');
        $hourType = $request->input('hour_type');
        $deletedTimeTrackings = $request->input('deletedTimeTrackings', []);

        // Gestion des suppressions de TimeTracking
        foreach ($deletedTimeTrackings as $deleted) {
            $timeTracking = TimeTracking::where('project_id', $deleted['project_id'])
                ->where('employee_id', $deleted['employee_id'])
                ->where('date', $deleted['date'])
                ->first();

            if ($timeTracking) {
                // Ne supprimer que le type d'heures sélectionné
                $timeTracking->{$hourType} = null;

                // Si les deux types d'heures sont null, on supprime l'enregistrement
                if (is_null($timeTracking->day_hours) && is_null($timeTracking->night_hours)) {
                    $timeTracking->delete();
                } else {
                    $timeTracking->save();
                }
            }
        }

        // Gestion des ajouts/mises à jour des TimeTracking
        foreach ($data as $employee) {
            $employee_id = $employee['employee_id'];
            $project_id = $employee['project_id'];
            $month = $employee['month'];
            $year = $employee['year'];

            foreach ($employee['days'] as $day => $hours) {
                $date = Carbon::createFromDate($year, $month, $day + 1)->format('Y-m-d');

                // Récupérer ou créer l'enregistrement de suivi de temps
                $timeTracking = TimeTracking::firstOrNew([
                    'project_id' => $project_id,
                    'employee_id' => $employee_id,
                    'date' => $date
                ]);

                // Mettre à jour uniquement le type d'heure sélectionné sans toucher à l'autre
                $timeTracking->{$hourType} = $hours !== null ? $hours : null;

                // Si les deux types d'heures sont null, supprimer l'enregistrement
                if (is_null($timeTracking->day_hours) && is_null($timeTracking->night_hours)) {
                    $timeTracking->delete();
                } else {
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

        // Vérifier si l'employé est déjà assigné au projet
        if ($employee->projects()->where('project_id', $project->id)->exists()) {
            return redirect()->route('pointage.show', [
                'project_id' => $project->id,
                'month' => $request->month,
                'year' => $request->year,
                'hour_type' => 'day_hours'
            ])->with('error', 'Cet employé est déjà assigné à ce projet.');
        }

        // Si l'employé n'est pas encore assigné, on l'ajoute
        $employee->projects()->attach($project->id);

        return redirect()->route('pointage.show', [
            'project_id' => $project->id,
            'month' => $request->month,
            'year' => $request->year,
            'hour_type' => 'day_hours' // Par défaut sur Jour
        ])->with('success', 'Employé ajouté au projet avec succès!');
    }
}
