<?php

namespace App\Filament\Resources\BasketResource\Pages;

use App\Filament\Resources\BasketResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBasket extends ViewRecord
{
    protected static string $resource = BasketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
