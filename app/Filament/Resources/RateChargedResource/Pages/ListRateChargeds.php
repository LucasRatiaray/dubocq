<?php

namespace App\Filament\Resources\RateChargedResource\Pages;

use App\Filament\Resources\RateChargedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRateChargeds extends ListRecords
{
    protected static string $resource = RateChargedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
