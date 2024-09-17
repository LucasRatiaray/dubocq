<?php

namespace App\Filament\Resources\NonWorkingDayResource\Pages;

use App\Filament\Resources\NonWorkingDayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNonWorkingDays extends ListRecords
{
    protected static string $resource = NonWorkingDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
