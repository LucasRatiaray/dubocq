<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function employeeBasketZones(): HasMany
    {
        return $this->hasMany(EmployeeBasketZone::class);
    }

    // Méthode pour calculer les heures de jour
    public function getTotalDayHours($timeTrackings): float
    {
        return $timeTrackings->where('employee_id', $this->id)->sum('day_hours');
    }

    // Méthode pour calculer les heures de nuit
    public function getTotalNightHours($timeTrackings): float
    {
        return $timeTrackings->where('employee_id', $this->id)->sum('night_hours');
    }

    // Méthode pour calculer le total d'heures (jour + nuit)
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
                $day = (int) \Carbon\Carbon::parse($timeTracking->date)->format('d');
                $days[$day - 1] = $timeTracking->$hourType; // Mettre l'heure pour le jour correspondant
            }
        }

        return $days;
    }

}
