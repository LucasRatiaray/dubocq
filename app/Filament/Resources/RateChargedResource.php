<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RateChargedResource\Pages;
use App\Filament\Resources\RateChargedResource\RelationManagers;
use App\Models\RateCharged;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RateChargedResource extends Resource
{
    protected static ?string $model = RateCharged::class;

    protected static ?string $navigationIcon = 'heroicon-m-arrow-trending-up';

    protected static ?string $navigationLabel = 'Taux Chargé';

    protected static ?string $modelLabel = 'Taux Chargé';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Taux Chargé')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Valeur:')
                            ->suffix('%')
                            ->numeric()
                            ->step('0.01')
                            ->required(),
                    ])->columnSpan(1), // Cette section occupe 1/4 de la largeur
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('value')
                    ->label('Valeur')
                    ->badge()
                    ->colors([
                        'success' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->sortable()
                    ->suffix(' %'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                /*Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRateChargeds::route('/'),
            //'create' => Pages\CreateRateCharged::route('/create'),
            'view' => Pages\ViewRateCharged::route('/{record}'),
            'edit' => Pages\EditRateCharged::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }
}
