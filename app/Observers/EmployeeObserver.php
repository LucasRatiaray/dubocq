<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Basket;
use App\Models\BasketZone;
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

    // Méthode pour mettre à jour les enregistrements d'EmployeeBasketZone
    public function saved(Employee $employee): void
    {
        // Mettre à jour tous les EmployeeBasketZones associés à cet employé
        $employeeBasketZones = EmployeeBasketZone::where('employee_id', $employee->id)->get();
        $this->updateEmployeeBasketZones($employee, $employeeBasketZones);
    }

    protected function updateEmployeeBasketZones(Employee $employee, $employeeBasketZones): void
    {
        foreach ($employeeBasketZones as $employeeBasketZone) {
            $basketZone = BasketZone::find($employeeBasketZone->zone_id);

            if ($employee->status === 'OUVRIER') {
                $employeeBasketZone->employee_basket_zone_charged = $basketZone->basket_zone_charged / ($employee->contract / 5);
                $employeeBasketZone->employee_basket_zone = $employeeBasketZone->employee_basket_zone_charged + $employee->basket;
            } elseif ($employee->status === 'ETAM') {
                $employeeBasketZone->employee_basket_zone_charged = $employee->basket;
            }

            // Sauvegarder les changements
            $employeeBasketZone->save();
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
