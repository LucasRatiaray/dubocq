<?php

namespace App\Filament\Resources\RateChargedResource\Pages;

use App\Filament\Resources\RateChargedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRateCharged extends EditRecord
{
    protected static string $resource = RateChargedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\ViewAction::make(),
            //Actions\DeleteAction::make(),
        ];
    }
}
