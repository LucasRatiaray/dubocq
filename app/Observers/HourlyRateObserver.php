<?php

namespace App\Observers;

use App\Models\HourlyRate;
use App\Models\BasketZone;

class HourlyRateObserver
{
    public function saving(HourlyRate $hourlyRate): void
    {
        $employee = $hourlyRate->employee;
        $basketZone = BasketZone::where('zone_id', $hourlyRate->zone_id)->first();

        if ($employee && $basketZone) {
            if ($employee->contract === '37H') {
                $basketZoneChargedDaily = $basketZone->basket_zone_charged_daily_37H;
            } else {
                $basketZoneChargedDaily = $basketZone->basket_zone_charged_daily_35H;
            }

            $hourlyRate->rate = $employee->basket + $basketZoneChargedDaily;
        }
    }
}
