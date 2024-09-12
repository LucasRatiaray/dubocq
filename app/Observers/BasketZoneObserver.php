<?php

namespace App\Observers;

use App\Models\BasketZone;
use App\Models\RateCharged;

class BasketZoneObserver
{
    public function saving(BasketZone $basketZone): void
    {
        $rateCharged = RateCharged::first();

        if ($basketZone->basket_zone) {
            $basketZone->basket_zone_charged = $basketZone->basket_zone * $rateCharged->rate_charged;
        }
    }
}
