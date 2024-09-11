<?php

use App\Http\Controllers\PointageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pointage', [PointageController::class, 'index'])->name('pointage.index');
    Route::match(['post','get'],'/pointage/show', [PointageController::class, 'show'])->name('pointage.show');
    Route::post('/pointage/store', [PointageController::class, 'store'])->name('pointage.store');
    Route::post('/pointage/add/{id}', [PointageController::class, 'addEmployeeToProject'])->name('pointage.add');

    Route::get('/projects/{project}', [ProjectController::class, 'show']);

    /*Route::redirect('/setting', '/admin')->name('setting');*/

    Route::get('/setting', function () {
        return view('setting');
    })->name('setting');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
