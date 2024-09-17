<?php

namespace App\Filament\Resources\NonWorkingDayResource\Pages;

use App\Filament\Resources\NonWorkingDayResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNonWorkingDay extends ViewRecord
{
    protected static string $resource = NonWorkingDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
