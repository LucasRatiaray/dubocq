<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function show(): View
    {
        $projects = Project::with('timeTrackings')->get();

        return view('dashboard', compact('projects'));
    }
}
