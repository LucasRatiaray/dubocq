<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\Employee;
use App\Models\RateCharged;

class EmployeeObserver
{
    public function saving(Employee $employee): void
    {
        $rateCharged = RateCharged::first();
        $basket = Basket::first();

        if ($employee->monthly_salary) {
            $employee->hourly_rate = $employee->monthly_salary / ($employee->contract * 52 / 12);
            $employee->hourly_rate_charged = $employee->hourly_rate * $rateCharged->rate_charged;
            $employee->hourly_basket_charged = $basket->basket_charged / ($employee->contract / 5);
            $employee->basket = $employee->hourly_rate_charged + $employee->hourly_basket_charged;
        }
    }

    public function created(Employee $employee): void
    {
        //
    }

    public function deleting(Employee $employee): void
    {
        $this->deleteHourlyRates($employee);
    }

    protected function deleteHourlyRates(Employee $employee): void
    {
        //
    }
}
