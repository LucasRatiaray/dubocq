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


    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class);
    }
}
