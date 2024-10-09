<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// Common Routes Accessible by Super Admin, Administrateur, and Conducteur
Route::middleware(['auth', 'role:Super Admin,Administrateur,Conducteur'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Pointage Routes
    Route::get('/pointage', [PointageController::class, 'index'])->name('pointage.index');
    Route::match(['post', 'get'], '/pointage/show', [PointageController::class, 'show'])->name('pointage.show');
    Route::post('/pointage/store', [PointageController::class, 'store'])->name('pointage.store');
    Route::post('/pointage/add/{id}', [PointageController::class, 'addEmployeeToProject'])->name('pointage.add');

    // Dashboard Routes Accessible by Conducteur
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/projects', [DashboardController::class, 'showProject'])->name('dashboard.showProject');
    Route::post('/dashboard/project-data', [DashboardController::class, 'getProjectData'])->name('dashboard.getProjectData');
});

// Dashboard Routes Accessible Only by Super Admin and Administrateur
Route::middleware(['auth', 'role:Super Admin,Administrateur'])->group(function () {
    // Settings Route
    Route::get('/setting', function () {
        return view('setting');
    })->name('setting');

    // Additional Dashboard Routes
    Route::get('/dashboard/employee', [DashboardController::class, 'showEmployee'])->name('dashboard.showEmployee');
    Route::post('/dashboard/employee-data', [DashboardController::class, 'getEmployeeData'])->name('dashboard.getEmployeeData');
    Route::post('/dashboard/get-employee-project-type-data', [DashboardController::class, 'getEmployeeProjectTypeData'])->name('dashboard.getEmployeeProjectTypeData');
    Route::get('/dashboard/summary', [DashboardController::class, 'showSummary'])->name('dashboard.showSummary');
});

// Authentication Routes
require __DIR__.'/auth.php';
