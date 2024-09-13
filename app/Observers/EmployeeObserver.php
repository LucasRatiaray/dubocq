<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\BasketZone;
use App\Models\Employee;
use App\Models\EmployeeBasketZone;
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

    public function updateEmployeeHourlyBasketCharged(): void
    {
        $basket = Basket::first();
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $employee->hourly_basket_charged = $basket->basket_charged / ($employee->contract / 5);
            $employee->basket = $employee->hourly_rate_charged + $employee->hourly_basket_charged;
            $employee->save();
        }
    }

    public function created(Employee $employee): void
    {
        // Récupérer toutes les zones existantes
        $basketZones = BasketZone::all();

        // Créer des enregistrements pour chaque zone
        foreach ($basketZones as $basketZone) {
            if ($employee->status === 'OUVRIER') {
                $employeeBasketZoneCharged = $basketZone->basket_zone_charged / ($employee->contract / 5);
            } elseif ($employee->status === 'ETAM') {
                $employeeBasketZoneCharged = $employee->basket;
            } else {
                continue;
            }

            // Créer un nouvel enregistrement pour chaque zone
            EmployeeBasketZone::create([
                'employee_id' => $employee->id,
                'zone_id' => $basketZone->id,
                'employee_basket_zone_charged' => $employeeBasketZoneCharged,
            ]);
        }
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
