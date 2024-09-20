<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'hourly_rate',
        'hourly_rate_charged',
        'status',
        'contract',
        'monthly_salary',
        'hourly_basket_charged',
        'basket',
        'archived'
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_projects');
    }

    public function employeeProjects(): HasMany
    {
        return $this->hasMany(EmployeeProject::class);
    }

    public function employeeBasketZones(): HasMany
    {
        return $this->hasMany(EmployeeBasketZone::class);
    }

    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class);
    }

    public function getTotalDayHours($timeTrackings): float
    {
        return $timeTrackings->where('employee_id', $this->id)->sum('day_hours');
    }

    public function getTotalNightHours($timeTrackings): float
    {
        return $timeTrackings->where('employee_id', $this->id)->sum('night_hours');
    }

    public function getTotalHours($timeTrackings): float
    {
        $dayHours = $this->getTotalDayHours($timeTrackings);
        $nightHours = $this->getTotalNightHours($timeTrackings);
        return $dayHours + $nightHours;
    }

    public function getHoursByDay($timeTrackings, $daysInMonth, $hourType): array
    {
        $days = array_fill(0, $daysInMonth, '');

        foreach ($timeTrackings as $timeTracking) {
            if ($timeTracking->employee_id == $this->id) {
                $day = (int) Carbon::parse($timeTracking->date)->format('d');
                $days[$day - 1] = $timeTracking->$hourType;
            }
        }
        return $days;
    }

    public function getEmployeeCost($timeTrackings): float
    {
        $totalHours = $this->getTotalHours($timeTrackings);

        // Récupérer le tarif horaire de l'employé pour la zone du projet
        $employeeBasketZone = $this->employeeBasketZones->first(); // Assure-toi de bien gérer la relation avec les zones

        if ($employeeBasketZone) {
            return $totalHours * $employeeBasketZone->employee_basket_zone;
        }

        return 0; // Si aucune zone trouvée, retourne 0
    }

}
