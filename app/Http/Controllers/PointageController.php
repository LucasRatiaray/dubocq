<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\TimeTracking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

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
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $employees = Employee::join('employee_projects', 'employees.id', '=', 'employee_projects.employee_id')
            ->where('employee_projects.project_id', $project->id)
            ->get(['employees.*', 'employee_projects.id as employee_project_id']);

        $allEmployees = $this->getAvailableEmployees($project->id);

        $timeTrackings = TimeTracking::where('project_id', $project->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $employeeData = [];
        foreach ($employees as $employee) {
            $days = array_fill(0, $daysInMonth, '');

            foreach ($timeTrackings as $timeTracking) {
                if ($timeTracking->employee_id == $employee->id) {
                    $day = (int) Carbon::parse($timeTracking->date)->format('d');
                    $days[$day - 1] = $timeTracking->day_hours;  // Utilisation de 'day_hours' au lieu de 'hours'
                }
            }

            $employeeData[] = [
                'employee_project_id' => $employee->employee_project_id,
                'employee_id' => $employee->id,
                'full_name' => $employee->last_name . ' ' . $employee->first_name,
                'days' => $days
            ];
        }

        return view('pointage', compact('projects', 'project', 'month', 'year', 'employeeData', 'allEmployees'));
    }

    public function store(Request $request): JsonResponse
    {
        Log::info('store method called', ['data' => $request->all()]);

        try {
            $request->validate([
                'data' => 'required|array',
            ]);

            $data = $request->input('data');

            if (!is_array($data)) {
                Log::error('Invalid data format', ['data' => $data]);
                return response()->json(['success' => false, 'message' => 'Invalid data format.'], 400);
            }

            foreach ($data as $employee) {
                if (!is_array($employee) || !isset($employee['employee_id'], $employee['project_id'], $employee['month'], $employee['year'], $employee['days'])) {
                    Log::error('Invalid employee entry', ['employee' => $employee]);
                    continue; // Skip invalid entries
                }

                $employee_id = $employee['employee_id'];
                $project_id = $employee['project_id'];
                $month = $employee['month'];
                $year = $employee['year'];

                // Vérifiez si les valeurs ne sont pas nulles
                if (is_null($employee_id) || is_null($project_id)) {
                    Log::error('Null value detected', ['employee_id' => $employee_id, 'project_id' => $project_id]);
                    continue;
                }

                foreach ($employee['days'] as $day => $day_hours) {  // Renommé 'hours' en 'day_hours'
                    if ($day_hours !== null) {
                        $date = Carbon::createFromDate($year, $month, $day + 1)->format('Y-m-d');
                        Log::info('Saving data', [
                            'project_id' => $project_id,
                            'employee_id' => $employee_id,
                            'date' => $date,
                            'day_hours' => $day_hours  // Renommé 'hours' en 'day_hours'
                        ]);
                        TimeTracking::updateOrCreate(
                            [
                                'project_id' => $project_id,
                                'employee_id' => $employee_id,
                                'date' => $date
                            ],
                            [
                                'project_id' => $project_id,
                                'employee_id' => $employee_id,
                                'day_hours' => $day_hours  // Renommé 'hours' en 'day_hours'
                            ]
                        );
                    }
                }
            }

            Log::info('Data saved successfully');
            return response()->json(['success' => true, 'message' => 'Données sauvegardées avec succès!']);
        } catch (\Exception $e) {
            Log::error('Error saving data', ['exception' => $e]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
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
            'year' => $request->year
        ])->with('success', 'Employé ajouté au projet avec succès!');
    }
}
