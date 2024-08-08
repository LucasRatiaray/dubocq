<?php

namespace App\Observers;

use App\Models\Basket;

class BasketObserver
{
    public function saving(Basket $basket): void
    {
        if (isset($basket->basket)) {
            $basket->basket_charged = Basket::calculateBasketCharged($basket->basket);
            $basket->basket_charged_daily_37H = Basket::calculateBasketChargedDaily37H($basket->basket_charged);
            $basket->basket_charged_daily_35H = Basket::calculateBasketChargedDaily35H($basket->basket_charged);
        }
    }
}
