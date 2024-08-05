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
        'description',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function hourlyRats(): BelongsToMany
    {
        return $this->belongsToMany(HourlyRate::class);
    }

    public function timeTrackings(): BelongsToMany
    {
        return $this->belongsToMany(TimeTracking::class);
    }
}
