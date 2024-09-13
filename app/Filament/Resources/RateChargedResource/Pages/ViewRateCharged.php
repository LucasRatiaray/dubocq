<?php

namespace App\Filament\Resources\RateChargedResource\Pages;

use App\Filament\Resources\RateChargedResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRateCharged extends ViewRecord
{
    protected static string $resource = RateChargedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
