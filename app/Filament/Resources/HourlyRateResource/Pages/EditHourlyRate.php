<?php

namespace App\Filament\Resources\HourlyRateResource\Pages;

use App\Filament\Resources\HourlyRateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHourlyRate extends EditRecord
{
    protected static string $resource = HourlyRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
