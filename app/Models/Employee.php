<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected static float $rateIncreasePercentage = 0.70; // 70%

    public static function setRateIncreasePercentage($percentage): void
    {
        self::$rateIncreasePercentage = $percentage;
    }

    public static function getRateIncreasePercentage(): float
    {
        return self::$rateIncreasePercentage;
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_projects');
    }

    public function hourlyRates(): BelongsToMany
    {
        return $this->belongsToMany(HourlyRate::class);
    }

    public function timeTrackings(): BelongsToMany
    {
        return $this->belongsToMany(TimeTracking::class);
    }

    public function baskets(): BelongsToMany
    {
        return $this->belongsToMany(Basket::class);
    }
}
