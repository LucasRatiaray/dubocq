<?php

namespace App\Filament\Resources\NonWorkingDayResource\Pages;

use App\Filament\Resources\NonWorkingDayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNonWorkingDay extends EditRecord
{
    protected static string $resource = NonWorkingDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
