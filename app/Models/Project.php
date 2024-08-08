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

    public function employeeProjects(): HasMany
    {
        return $this->hasMany(EmployeeProject::class);
    }

    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class, 'time_tracking_project');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }


    public function calculateTotalCost(): float
    {
        $totalCost = 0;

        foreach ($this->employeeProjects as $employeeProject) {
            $employee = $employeeProject->employee;
            $totalCost += $employee->calculateCostForProject($this);
        }

        return $totalCost;
    }

    public function calculateMonthlyCost()
    {
        $monthlyCosts = collect();

        foreach ($this->employeeProjects as $employeeProject) {
            $employee = $employeeProject->employee;
            $employeeMonthlyCosts = $employee->calculateMonthlyCostForProject($this);

            foreach ($employeeMonthlyCosts as $month => $cost) {
                if (isset($monthlyCosts[$month])) {
                    $monthlyCosts[$month] += $cost;
                } else {
                    $monthlyCosts[$month] = $cost;
                }
            }
        }

        return $monthlyCosts;
    }

    public function calculateMonthlyEmployeeCosts()
    {
        $monthlyEmployeeCosts = [];

        foreach ($this->employeeProjects as $employeeProject) {
            $employee = $employeeProject->employee;
            $employeeMonthlyCosts = $employee->calculateMonthlyCostForProject($this);

            foreach ($employeeMonthlyCosts as $month => $cost) {
                if (!isset($monthlyEmployeeCosts[$month])) {
                    $monthlyEmployeeCosts[$month] = [];
                }

                $monthlyEmployeeCosts[$month][] = [
                    'employee' => $employee,
                    'cost' => $cost,
                ];
            }
        }

        return $monthlyEmployeeCosts;
    }
}
