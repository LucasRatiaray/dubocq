<?php

use App\Http\Controllers\PointageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::match(['get', 'post'], '/pointage', [PointageController::class, 'index'])
    ->name('pointage.index')
    ->middleware(['auth', 'verified']);

Route::match(['get', 'post'],'/pointage/table', [PointageController::class, 'show'])->name('pointage.table');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::redirect('/dashboard', '/admin')->name('dashboard');
});

require __DIR__.'/auth.php';
