<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Basket;
use App\Models\BasketZone;
use App\Models\EmployeeBasketZone;
use App\Models\RateCharged;

class EmployeeObserver
{
    public function saving(Employee $employee): void
    {
        $rateCharged = RateCharged::first();
        $basket = Basket::first();

        if ($employee->monthly_salary !== null && $employee->contract !== null) {
            $employee->hourly_rate = $employee->monthly_salary / ($employee->contract * 52 / 12);
            $employee->hourly_rate_charged = $employee->hourly_rate * $rateCharged->rate_charged;
            $employee->hourly_basket_charged = $basket->basket_charged / ($employee->contract / 5);
            $employee->basket_day = $employee->hourly_rate_charged + $employee->hourly_basket_charged;
            $employee->basket_night = ($employee->hourly_rate_charged * 2) + $employee->hourly_basket_charged;
        }

        if ($employee->status === 'INTERIMAIRE') {
            $employee->monthly_salary = null;
            $employee->hourly_rate_charged = null;
            $employee->hourly_basket_charged = null;
            $employee->basket_day = null;
            $employee->basket_night = null;
            $employee->employeeBasketZones()->delete();
        }
    }

    // Méthode pour mettre à jour les enregistrements d'EmployeeBasketZone
    public function saved(Employee $employee): void
    {
        // Vérifier si le statut a changé
        if ($employee->wasChanged('status')) {
            $originalStatus = $employee->getOriginal('status');
            $newStatus = $employee->status;

            // Si le statut passe de INTERIMAIRE à OUVRIER ou ETAM
            if ($originalStatus === 'INTERIMAIRE' && in_array($newStatus, ['OUVRIER', 'ETAM'])) {
                // Recréer les enregistrements EmployeeBasketZone
                $this->createEmployeeBasketZones($employee);
            }
        }

        // Mettre à jour tous les EmployeeBasketZones associés à cet employé
        $employeeBasketZones = EmployeeBasketZone::where('employee_id', $employee->id)->get();
        $this->updateEmployeeBasketZones($employee, $employeeBasketZones);
    }

    protected function updateEmployeeBasketZones(Employee $employee, $employeeBasketZones): void
    {
        foreach ($employeeBasketZones as $employeeBasketZone) {
            $basketZone = BasketZone::find($employeeBasketZone->zone_id);

            if ($employee->status === 'OUVRIER') {
                $employeeBasketZone->employee_basket_zone_charged = $basketZone->basket_zone_charged / ($employee->contract / 5);
                $employeeBasketZone->employee_basket_zone_day = $employeeBasketZone->employee_basket_zone_charged + $employee->basket_day;
                $employeeBasketZone->employee_basket_zone_night = $employeeBasketZone->employee_basket_zone_charged + $employee->basket_night;
            } elseif ($employee->status === 'ETAM') {
                $employeeBasketZone->employee_basket_zone_charged = $employee->basket_day;
                $employeeBasketZone->employee_basket_zone_day = $employee->basket_day;
                $employeeBasketZone->employee_basket_zone_night = $employee->basket_night;
            } elseif ($employee->status === 'INTERIMAIRE') {
                $employeeBasketZone->employee_basket_zone_charged = 0;
                $employeeBasketZone->employee_basket_zone_day = 0;
            }

            // Sauvegarder les changements
            $employeeBasketZone->save();
        }
    }

    protected function createEmployeeBasketZones(Employee $employee): void
    {
        // Récupérer toutes les zones existantes
        $basketZones = BasketZone::all();
        $rateCharged = RateCharged::first();
        $basket = Basket::first();

        if ($employee->monthly_salary !== null && $employee->contract !== null) {
            $employee->hourly_rate = $employee->monthly_salary / ($employee->contract * 52 / 12);
            $employee->hourly_rate_charged = $employee->hourly_rate * $rateCharged->rate_charged;
            $employee->hourly_basket_charged = $basket->basket_charged / ($employee->contract / 5);
            $employee->basket_day = $employee->hourly_rate_charged + $employee->hourly_basket_charged;
            $employee->basket_night = ($employee->hourly_rate_charged * 2) + $employee->hourly_basket_charged;
        }

        // Créer des enregistrements pour chaque zone
        foreach ($basketZones as $basketZone) {
            if ($employee->status === 'OUVRIER') {
                $employeeBasketZoneCharged = $basketZone->basket_zone_charged / ($employee->contract / 5);
                $employeeBasketZoneDayValue = $employeeBasketZoneCharged + $employee->basket_day;
                $employeeBasketZoneNightValue = $employeeBasketZoneCharged + $employee->basket_night;
            } elseif ($employee->status === 'ETAM') {
                $employeeBasketZoneCharged = $employee->basket_day;
                $employeeBasketZoneDayValue = $employee->basket_day;
                $employeeBasketZoneNightValue = $employee->basket_night;
            } else {
                continue;
            }

            // Créer un nouvel enregistrement pour chaque zone
            EmployeeBasketZone::create([
                'employee_id' => $employee->id,
                'zone_id' => $basketZone->id,
                'employee_basket_zone_charged' => $employeeBasketZoneCharged,
                'employee_basket_zone_day' => $employeeBasketZoneDayValue,
                'employee_basket_zone_night' => $employeeBasketZoneNightValue
            ]);
        }
    }

    public function created(Employee $employee): void
    {
        $this->createEmployeeBasketZones($employee);
    }

    public function deleting(Employee $employee): void
    {
        $this->deleteHourlyRates($employee);
    }

    protected function deleteHourlyRates(Employee $employee): void
    {
        //
    }
}
