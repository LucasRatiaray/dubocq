<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'zone_id',
        'city',
        'address',
        'business',
        'kilometers',
        'driver_id',
        'archived',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(Code::class, 'code_id');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_projects');
    }

    public function employeeProjects(): HasMany
    {
        return $this->hasMany(EmployeeProject::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class);
    }

    public function timeTrackingsCurrentMonth(): HasMany
    {
        return $this->hasMany(TimeTracking::class)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year);
    }


    public function getEarliestEntryDate()
    {
        $earliestDate = $this->timeTrackings()->min('date');

        return $earliestDate ? Carbon::parse($earliestDate) : null;
    }

    public function getHoursThisMonth(): float
    {
        return $this->timeTrackings()
                ->whereMonth('date', now()->month)
                ->sum('day_hours') + $this->timeTrackings()
                ->whereMonth('date', now()->month)
                ->sum('night_hours');
    }

    public function getTotalHours(): float
    {
        return $this->timeTrackings()->sum('day_hours') + $this->timeTrackings()->sum('night_hours');
    }

    public function calculateMonthlyCost(): float
    {
        $totalCost = 0;

        $currentMonth = now()->month;
        $currentYear = now()->year;

        foreach ($this->employees as $employee) {
            // Récupérer les timeTrackings pour cet employé sur ce projet durant le mois en cours
            $timeTrackings = $employee->timeTrackings()
                ->where('project_id', $this->id)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->get();

            // Calculer le coût en utilisant la méthode mise à jour
            $employeeCost = $employee->getEmployeeCost($timeTrackings, $this->zone_id);
            $totalCost += $employeeCost;
        }

        return $totalCost;
    }

    public function calculateTotalCost(): float
    {
        $totalCost = 0;

        foreach ($this->employees as $employee) {
            // Récupérer tous les timeTrackings pour cet employé sur ce projet
            $timeTrackings = $employee->timeTrackings()
                ->where('project_id', $this->id)
                ->get();

            // Calculer le coût en utilisant la méthode mise à jour
            $employeeCost = $employee->getEmployeeCost($timeTrackings, $this->zone_id);
            $totalCost += $employeeCost;
        }

        return $totalCost;
    }
}
