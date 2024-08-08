<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Basket;
use App\Models\HourlyRate;
use App\Models\Zone;

class EmployeeObserver
{
    public function saving(Employee $employee): void
    {
        // Calculer le taux horaire chargé avant de sauvegarder
        if ($employee->hourly_rate) {
            $employee->hourly_rate_charged = $employee->hourly_rate * (1 + Employee::getRateIncreasePercentage());
        } else {
            $employee->hourly_rate_charged = null;
        }

        // Assume that you have a way to get the relevant basket
        // For this example, I'll fetch the first basket. Adjust as needed.
        $basket = Basket::first(); // Adjust this line to get the correct basket for your logic

        if ($basket && $employee->hourly_rate_charged) {
            if ($employee->contract === '37H') {
                $basketChargedDaily = $basket->basket_charged_daily_37H;
            } else {
                $basketChargedDaily = $basket->basket_charged_daily_35H;
            }

            $employee->basket = $employee->hourly_rate_charged + $basketChargedDaily;
        }
    }

    public function created(Employee $employee): void
    {
        $this->createHourlyRates($employee);
    }

    public function deleting(Employee $employee): void
    {
        $this->deleteHourlyRates($employee);
    }

    protected function createHourlyRates(Employee $employee): void
    {
        $zones = Zone::all();

        foreach ($zones as $zone) {
            HourlyRate::create([
                'employee_id' => $employee->id,
                'zone_id' => $zone->id,
            ]);
        }
    }

    protected function deleteHourlyRates(Employee $employee): void
    {
        HourlyRate::where('employee_id', $employee->id)->delete();
    }
}
