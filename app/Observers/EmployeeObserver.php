<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Basket;
use App\Models\HourlyRate;
use App\Models\RateCharged;
use App\Models\Zone;

class EmployeeObserver
{
    public function saving(Employee $employee): void
    {
        $rateCharged = RateCharged::first();

        if ($employee->monthly_salary) {
            $employee->hourly_rate = $employee->monthly_salary / ($employee->contract * 52 / 12);
            $employee->hourly_rate_charged = $employee->hourly_rate * $rateCharged->rate_charged;
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
