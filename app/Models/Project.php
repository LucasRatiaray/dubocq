<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'zone_id',
        'city',
        'address',
        'business',
        'kilometers',
        'driver_id',
        'archived',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(Code::class, 'code_id');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_projects');
    }

    public function employeeProjects(): HasMany
    {
        return $this->hasMany(EmployeeProject::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function timeTrackings(): HasMany
    {
        return $this->hasMany(TimeTracking::class);
    }

    public function getHoursThisMonth(): float
    {
        return $this->timeTrackings()
                ->whereMonth('date', now()->month)
                ->sum('day_hours') + $this->timeTrackings()
                ->whereMonth('date', now()->month)
                ->sum('night_hours');
    }

    public function getTotalHours(): float
    {
        return $this->timeTrackings()->sum('day_hours') + $this->timeTrackings()->sum('night_hours');
    }

    public function calculateMonthlyCost(): float
    {
        $totalCost = 0;

        // Récupérer les timeTrackings du mois en cours pour ce projet
        $timeTrackingsThisMonth = $this->timeTrackings()
            ->whereMonth('date', now()->month)
            ->get();

        // Si aucun timeTracking pour ce mois, retourner 0
        if ($timeTrackingsThisMonth->isEmpty()) {
            // Loguer une erreur pour faciliter le débogage (optionnel)
            Log::warning('Aucun timeTracking pour le projet ' . $this->business . ' sur le mois en cours.');
            return 0;
        }

        // Parcourir chaque timeTracking
        foreach ($timeTrackingsThisMonth as $timeTracking) {
            $employee = $timeTracking->employee;

            // Vérifier si l'employé a une EmployeeBasketZone pour la zone du projet
            $employeeBasketZone = $employee->employeeBasketZones()
                ->where('zone_id', $this->zone_id)
                ->first();

            // Si aucune EmployeeBasketZone n'est trouvée, loguer une erreur et continuer
            if (!$employeeBasketZone) {
                Log::error('Aucune EmployeeBasketZone trouvée pour l\'employé ' . $employee->first_name . ' sur le projet ' . $this->business . ' et la zone ' . $this->zone_id);
                continue; // Passer à l'employé suivant
            }

            // Calcul des heures travaillées
            $dayHours = $timeTracking->day_hours ?? 0;
            $nightHours = $timeTracking->night_hours ?? 0;
            $totalHours = $dayHours + $nightHours;

            // Si le tarif est nul ou incorrect, loguer une erreur et continuer
            if ($employeeBasketZone->employee_basket_zone == 0) {
                Log::error('Le tarif est zéro pour l\'employé ' . $employee->first_name . ' dans la zone ' . $this->zone_id . ' sur le projet ' . $this->business);
                continue; // Passer à l'employé suivant
            }

            // Calcul du coût pour cet employé
            $employeeCost = $totalHours * $employeeBasketZone->employee_basket_zone;
            $totalCost += $employeeCost;
        }

        return $totalCost;
    }

    public function calculateTotalCost(): float
    {
        $totalCost = 0;

        // Récupérer tous les timeTrackings pour ce projet (sans filtrer par mois)
        $timeTrackings = $this->timeTrackings()->get();

        if ($timeTrackings->isEmpty()) {
            // Aucun timeTracking pour ce projet, retourner 0
            return 0;
        }

        // Parcourir chaque timeTracking
        foreach ($timeTrackings as $timeTracking) {
            $employee = $timeTracking->employee;

            // Vérifier si l'employé a une EmployeeBasketZone pour la zone du projet
            $employeeBasketZone = $employee->employeeBasketZones()
                ->where('zone_id', $this->zone_id)
                ->first();

            if (!$employeeBasketZone) {
                // Passer cet employé si aucun tarif n'est trouvé pour cette zone
                Log::error('Aucune EmployeeBasketZone trouvée pour l\'employé ' . $employee->first_name . ' sur le projet ' . $this->business . ' et la zone ' . $this->zone_id);
                continue;
            }

            // Calcul des heures travaillées
            $dayHours = $timeTracking->day_hours ?? 0;
            $nightHours = $timeTracking->night_hours ?? 0;
            $totalHours = $dayHours + $nightHours;

            // Si le tarif est nul ou incorrect, loguer une erreur et continuer
            if ($employeeBasketZone->employee_basket_zone == 0) {
                Log::error('Le tarif est zéro pour l\'employé ' . $employee->first_name . ' dans la zone ' . $this->zone_id . ' sur le projet ' . $this->business);
                continue;
            }

            // Calcul du coût pour cet employé
            $employeeCost = $totalHours * $employeeBasketZone->employee_basket_zone;
            $totalCost += $employeeCost;
        }

        return $totalCost;
    }

}
