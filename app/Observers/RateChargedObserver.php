<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\Employee;
use App\Models\RateCharged;
use App\Models\BasketZone;

class RateChargedObserver
{
    /**
     * Handle the "saving" event.
     * Cette méthode est appelée avant la création ou la mise à jour d'un enregistrement.
     */
    public function saving(RateCharged $rateCharged): void
    {
        if (!is_null($rateCharged->value) && is_numeric($rateCharged->value)) {
            // Convertir la valeur en pourcentage et ajouter 100%
            $rateCharged->rate_charged = ($rateCharged->value / 100) + 1; // 1 correspond à 100%
        } else {
            // Si 'value' est null ou non numérique, on ne veut pas insérer un taux chargé incorrect
            $rateCharged->rate_charged = null;
        }
    }

    /**
     * Handle the "saved" event.
     * Cette méthode est appelée après la sauvegarde de l'enregistrement de RateCharged.
     */
    public function saved(RateCharged $rateCharged): void
    {
        // Après avoir sauvegardé RateCharged, mettre à jour les paniers, zones de panier et les employés
        $this->updateBaskets($rateCharged);
        $this->updateBasketZones($rateCharged);
        $this->updateEmployees($rateCharged);
    }

    /**
     * Mettre à jour tous les paniers (baskets) avec le nouveau taux de charge (rate_charged).
     */
    private function updateBaskets(RateCharged $rateCharged): void
    {
        // Récupérer tous les paniers (baskets)
        $baskets = Basket::all();

        foreach ($baskets as $basket) {
            // Recalcul du panier chargé en fonction de rate_charged
            if ($basket->basket) {
                $basket->basket_charged = $basket->basket * $rateCharged->rate_charged;

                // Sauvegarder les changements dans chaque panier
                $basket->save();
            }
        }
    }

    /**
     * Mettre à jour toutes les zones de paniers (basket_zones) avec le nouveau taux de charge (rate_charged).
     */
    private function updateBasketZones(RateCharged $rateCharged): void
    {
        // Récupérer toutes les zones de paniers
        $basketZones = BasketZone::all();

        foreach ($basketZones as $basketZone) {
            // Recalcul du panier de zone chargé en fonction de rate_charged
            if ($basketZone->basket_zone) {
                $basketZone->basket_zone_charged = $basketZone->basket_zone * $rateCharged->rate_charged;

                // Sauvegarder les changements dans chaque zone de panier
                $basketZone->save();
            }
        }
    }

    /**
     * Mettre à jour tous les employés (employees) avec les nouveaux calculs en fonction du panier mis à jour.
     */
    private function updateEmployees(RateCharged $rateCharged): void
    {
        // Récupérer tous les employés
        $employees = Employee::all();
        $basket = Basket::first(); // Utiliser le premier enregistrement de la table Baskets

        // Si aucun panier n'est trouvé, arrêter l'exécution de la fonction
        if (!$basket) {
            return;
        }

        foreach ($employees as $employee) {
            if ($employee->monthly_salary) {
                // Calcul du taux horaire
                $employee->hourly_rate = $employee->monthly_salary / ($employee->contract * 52 / 12);

                // Calcul du taux horaire facturé
                $employee->hourly_rate_charged = $employee->hourly_rate * $rateCharged->rate_charged;

                // Calcul du panier facturé
                $employee->hourly_basket_charged = $basket->basket_charged / ($employee->contract / 5);

                // Somme finale du panier
                $employee->basket = $employee->hourly_rate_charged + $employee->hourly_basket_charged;

                // Sauvegarder les changements de l'employé
                $employee->save();
            }
        }
    }
}
