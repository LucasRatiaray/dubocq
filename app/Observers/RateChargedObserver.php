<?php

namespace App\Observers;

use App\Models\RateCharged;

class RateChargedObserver
{
    /**
     * Handle the "saving" event.
     * This will be called before both creating and updating.
     */
    public function saving(RateCharged $rateCharged): void
    {
        if (!is_null($rateCharged->value) && is_numeric($rateCharged->value)) {
            // Convertir la valeur en pourcentage et ajouter 100%
            $rateCharged->rate_charged = ($rateCharged->value / 100) + 1; // 1 correspond à 100%
        } else {
            // Si value est null ou non numérique, définir rate_charged à null
            $rateCharged->rate_charged = null;
        }
    }
}
