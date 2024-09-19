<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
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
        return $this->belongsToMany(Employee::class, 'employee_project');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class);
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


}
