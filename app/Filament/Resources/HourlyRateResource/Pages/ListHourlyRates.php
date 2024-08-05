<?php

namespace App\Filament\Resources\HourlyRateResource\Pages;

use App\Filament\Resources\HourlyRateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHourlyRates extends ListRecords
{
    protected static string $resource = HourlyRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
