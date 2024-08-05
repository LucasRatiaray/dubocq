<?php

namespace App\Filament\Resources\HourlyRateResource\Pages;

use App\Filament\Resources\HourlyRateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHourlyRate extends ViewRecord
{
    protected static string $resource = HourlyRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
