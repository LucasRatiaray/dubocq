<?php

namespace App\Observers;

use App\Models\Basket;
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
}
