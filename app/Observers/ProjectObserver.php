<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Zone;
use App\Models\Code;

class ProjectObserver
{
    public function saving(Project $project): void
    {
        $this->assignZone($project);
        $this->assignCodeDescription($project);
    }

    protected function assignZone(Project $project): void
    {
        $kilometers = $project->kilometers;
        $zone = Zone::whereRaw('? BETWEEN kilometers_range_min AND kilometers_range_max', [$kilometers])->first();

        if ($zone) {
            $project->zone()->associate($zone);
        }
    }

    protected function assignCodeDescription(Project $project): void
    {
        $code = $project->code;

        if ($code) {
            if (str_starts_with($code, '1')) {
                $description = 'Logement Neuf';
            } elseif (str_starts_with($code, '2')) {
                $description = 'Monument Historique';
            } else {
                $description = null;
            }

            if ($description) {
                // Vérifiez si le code existe déjà dans la table 'codes'
                $existingCode = Code::where('code', $code)->first();
                if (!$existingCode) {
                    Code::create([
                        'code' => $code,
                        'description' => $description,
                    ]);
                }
            }
        }
    }
}
