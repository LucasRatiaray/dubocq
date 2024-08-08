<?php

namespace App\Observers;

use App\Models\BasketZone;

class BasketZoneObserver
{
    public function saving(BasketZone $basketZone): void
    {
        if (isset($basketZone->basket_zone)) {
            $basketZone->basket_zone_charged = BasketZone::calculateBasketCharged($basketZone->basket_zone);
            $basketZone->basket_zone_charged_daily_37H = BasketZone::calculateBasketChargedDaily37H($basketZone->basket_zone_charged);
            $basketZone->basket_zone_charged_daily_35H = BasketZone::calculateBasketChargedDaily35H($basketZone->basket_zone_charged);
        }
    }
}
