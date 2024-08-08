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
        'basket',
    ];

    public static function getRateIncreasePercentage(): float
    {
        return 0.70; // 70%
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_projects');
    }

    public function hourlyRates(): BelongsToMany
    {
        return $this->belongsToMany(HourlyRate::class);
    }

    public function baskets(): BelongsToMany
    {
        return $this->belongsToMany(Basket::class);
    }

    public function basketZones(): BelongsToMany
    {
        return $this->belongsToMany(BasketZone::class);
    }

    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class);
    }


    public function calculateHourlyCost(BasketZone $basketZone): float
    {
        if ($this->status === 'ETAM') {
            return $this->basket;
        } else {
            if ($this->contract === '37H') {
                $basketZoneChargedDaily = $basketZone->basket_zone_charged_daily_37H;
            } else {
                $basketZoneChargedDaily = $basketZone->basket_zone_charged_daily_35H;
            }
            return $this->basket + $basketZoneChargedDaily;
        }
    }

    public function calculateCostForProject(Project $project): float
    {
        $totalHours = $this->timeTrackings()->where('project_id', $project->id)->sum('hours');
        $basketZone = BasketZone::where('zone_id', $project->zone_id)->first();
        $hourlyCost = $this->calculateHourlyCost($basketZone);
        return $hourlyCost * $totalHours;
    }

    public function calculateMonthlyCostForProject(Project $project): object
    {
        $basketZone = BasketZone::where('zone_id', $project->zone_id)->first();
        $hourlyCost = $this->calculateHourlyCost($basketZone);

        return $this->timeTrackings()
            ->where('project_id', $project->id)
            ->selectRaw('SUM(hours) as total_hours, TO_CHAR(date, \'YYYY-MM\') as month')
            ->groupBy('month')
            ->get()
            ->mapWithKeys(function ($item) use ($hourlyCost) {
                return [$item->month => $item->total_hours * $hourlyCost];
            });
    }
}
