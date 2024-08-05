<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'business',
        'driver',
        'km',
        'year',
        'zoneId',
        'codeId'
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

    public function timeTrackings(): BelongsToMany
    {
        return $this->belongsToMany(TimeTracking::class, 'time_tracking_project');
    }
}
