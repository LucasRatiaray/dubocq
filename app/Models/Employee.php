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
        'basket_day',
        'basket_night',
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
        $totalHoursDay = $this->getTotalDayHours($timeTrackings);
        $totalHoursNight = $this->getTotalNightHours($timeTrackings);
        $totalHours = $totalHoursDay + $totalHoursNight;

        if ($this->status == 'INTERIMAIRE') {
            // For interim employees, cost is hourly_rate * total_hours
            return $this->hourly_rate * $totalHours;
        } else {
            // For other employees, use existing logic
            $employeeBasketZone = $this->employeeBasketZones->first();

            if ($employeeBasketZone) {
                $totalCostHoursDay = $totalHoursDay * $employeeBasketZone->employee_basket_zone_day;
                $totalCostHoursNight = $totalHoursNight * $employeeBasketZone->employee_basket_zone_night;

                return $totalCostHoursDay + $totalCostHoursNight;
            }

            return 0; // If no zone found, return 0
        }
    }
}
