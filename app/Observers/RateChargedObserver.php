<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\Employee;
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

    public function saved(RateCharged $rateCharged): void
    {
        // Appeler updateEmployees après avoir sauvegardé RateCharged
        $this->updateEmployees($rateCharged);
    }

    private function updateEmployees(RateCharged $rateCharged): void
    {
        $employees = Employee::all(); // Récupère tous les employés
        $basket = Basket::first(); // Vérifie également si un panier est récupéré

        if (!$basket) {
            return; // Sors de la fonction si aucun panier n'est trouvé
        }

        foreach ($employees as $employee) {
            if ($employee->monthly_salary) {
                // Calcul du taux horaire
                $employee->hourly_rate = $employee->monthly_salary / ($employee->contract * 52 / 12);

                // Calcul du taux horaire facturé
                $employee->hourly_rate_charged = $employee->hourly_rate * $rateCharged->rate_charged;

                // Calcul du panier facturé
                $employee->hourly_basket_charged = $basket->basket_charged / ($employee->contract / 5);

                // Somme finale
                $employee->basket = $employee->hourly_rate_charged + $employee->hourly_basket_charged;

                // Sauvegarder les changements de l'employé
                $employee->save();
            }
        }
    }
}
