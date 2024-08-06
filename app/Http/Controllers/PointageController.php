<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PointageController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $month = now()->month;
        $year = now()->year;

        return Inertia::render('Pointage', [
            'projects' => $projects,
            'month' => $month,
            'year' => $year,
            'employeeData' => [],
            'allemployes' => [],
            'project' => null,
        ]);
    }

    public function show(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $projects = Project::all();
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $employeeData = []; // Récupérez les données des employés selon vos besoins
        $allemployes = Employee::all(); // Récupérez tous les employés

        return Inertia::render('Pointage', [
            'project' => $project,
            'projects' => $projects,
            'month' => $month,
            'year' => $year,
            'employeeData' => $employeeData,
            'allemployes' => $allemployes,
        ]);
    }

    public function save(Request $request)
    {
        // Validez et sauvegardez les données envoyées depuis le formulaire Handsontable
        $data = $request->validate([
            'data' => 'required|array',
        ]);

        // Parcourez et sauvegardez chaque enregistrement
        foreach ($data['data'] as $record) {
            // Logique de sauvegarde, par exemple :
            // EmployeeData::updateOrCreate([...]);
        }

        return response()->json(['success' => true, 'message' => 'Données sauvegardées avec succès']);
    }
}
