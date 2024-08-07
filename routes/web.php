<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pointage', [PointageController::class, 'index'])->name('pointage');
    Route::post('/pointage', [PointageController::class, 'show'])->name('pointage');
    Route::post('/pointage/store', [PointageController::class, 'store'])->name('pointage.store');
    Route::post('/pointage/add/{id}', [PointageController::class, 'addEmployeeToProject'])->name('pointage.add');
    Route::get('/pointage/show', [PointageController::class, 'show'])->name('pointage.show');

    Route::get('/calculate-cost', [CostController::class, 'showForm'])->name('calculate-cost.form');
    Route::post('/calculate-cost', [CostController::class, 'calculateMonthlyCost'])->name('calculate-cost.calculate');

    Route::redirect('/dashboard', '/admin')->name('dashboard');
});

require __DIR__.'/auth.php';
