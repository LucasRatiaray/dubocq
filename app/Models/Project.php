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
        'codeId',
        'city',
        'address',
        'business',
        'km',
        'driver',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zoneId');
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(Code::class, 'codeId');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_project');
    }

    public function employeeProjects(): HasMany
    {
        return $this->hasMany(EmployeeProject::class);
    }

    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class, 'time_tracking_project');
    }
}
