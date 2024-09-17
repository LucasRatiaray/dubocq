<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\BasketZone;
use App\Models\Employee;
use App\Models\EmployeeBasketZone;

class EmployeeBasketZoneObserver
{
    /**
     * Handle the EmployeeBasketZone "saving" event.
     */
    public function saving(EmployeeBasketZone $employeeBasketZone): void
    {
        // Récupérer l'employé et la zone associée
        $employee = Employee::find($employeeBasketZone->employee_id);
        $basketZone = BasketZone::find($employeeBasketZone->zone_id);
        $basket = Basket::first();

        if ($employee && $basketZone) {
            // Calcul pour les employés OUVRIER
            if ($employee->status === 'OUVRIER') {
                $employeeBasketZone->employee_basket_zone_charged = $basketZone->basket_zone_charged / ($employee->contract / 5);
                $employeeBasketZone->employee_basket_zone = $employeeBasketZone->employee_basket_zone_charged + $employee->basket;
            }
            // Calcul pour les employés ETAM
            elseif ($employee->status === 'ETAM') {
                $employeeBasketZone->employee_basket_zone_charged = $basket->basket_charged / ($employee->contract / 5);
                $employeeBasketZone->employee_basket_zone = $employee->basket;
            }
        }
    }
}
