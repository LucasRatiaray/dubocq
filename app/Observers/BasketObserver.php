<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\Employee;
use App\Models\RateCharged;

class BasketObserver
{
    public function saving(Basket $basket): void
    {
        $rateCharged = RateCharged::first();

        if ($basket->basket) {
            $basket->basket_charged = $basket->basket * $rateCharged->rate_charged;
        }
    }

    public function saved(Basket $basket): void
    {
        // Après avoir mis à jour le panier, on met à jour tous les employés
        $this->updateEmployeesHourlyBasketCharged($basket);
    }

    private function updateEmployeesHourlyBasketCharged(Basket $basket): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            if ($employee->monthly_salary) {
                // Mise à jour du panier horaire facturé
                $employee->hourly_basket_charged = $basket->basket_charged / ($employee->contract / 5);
                $employee->basket = $employee->hourly_rate_charged + $employee->hourly_basket_charged;

                // Sauvegarder les changements pour l'employé
                $employee->save();
            }
        }
    }
}
