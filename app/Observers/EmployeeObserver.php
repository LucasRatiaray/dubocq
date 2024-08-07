<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function saving(Employee $employee): void
    {
        // Calculer le taux horaire chargé avant de sauvegarder
        if ($employee->hourly_rate) {
            $employee->hourly_rate_charged = $employee->hourly_rate * (1 + Employee::$rateIncreasePercentage);
        } else {
            $employee->hourly_rate_charged = null;
        }
    }
}
