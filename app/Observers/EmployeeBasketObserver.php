<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\EmployeeBasket;

class EmployeeBasketObserver
{
    /**
     * Handle the EmployeeBasket "saving" event.
     */
    public function saving(EmployeeBasket $employeeBasket): void
    {
        $basket = Basket::first();

        if ($employeeBasket->employee) {
            $employeeBasket->value = $basket->basket_charged / ($employeeBasket->employee->contract / 5);
        }
    }
}
