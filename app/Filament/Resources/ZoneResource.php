<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZoneResource\Pages;
use App\Filament\Resources\ZoneResource\RelationManagers;
use App\Models\Zone;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ZoneResource extends Resource
{
    protected static ?string $model = Zone::class;

    protected static ?string $navigationIcon = 'heroicon-s-map-pin';

    protected static ?string $navigationLabel = 'Zones';

    protected static ?string $modelLabel = 'Zone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(4) // Divise la ligne en 4 parties égales
                ->schema([
                    Section::make('Nom')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->prefix('Zone')
                            ->placeholder('ex: 52')
                            ->numeric()
                            ->step('1')
                            ->required(),
                    ])->columnSpan(1), // Cette section occupe 1/4 de la largeur

                    Section::make('Kilométrage') // Section pour les champs Km min et Km max
                    ->columns(2) // Dispose Km min et Km max côte à côte
                    ->schema([
                        Forms\Components\TextInput::make('kilometers_range_min')
                            ->label('Kilomètres min')
                            ->suffix('km')
                            ->placeholder('ex: 59.33')
                            ->required(),
                        Forms\Components\TextInput::make('kilometers_range_max')
                            ->label('Kilomètres max')
                            ->suffix('km')
                            ->placeholder('ex: 96.32')
                            ->required(),
                    ])->columnSpan(2), // Cette section occupe 2/4 de la largeur

                    Section::make('Tarif') // Section pour le champ Tarif
                    ->schema([
                        Forms\Components\TextInput::make('tariff')
                            ->label('Tarif')
                            ->suffix('€')
                            ->placeholder('ex: 23')
                            ->required(),
                    ])->columnSpan(1), // Cette section occupe 1/4 de la largeur
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->badge()
                    ->colors([
                        'warning' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->prefix('Zone ')
                    ->toggleable(),
                TextColumn::make('kilometers_range_min')
                    ->label('Kilomètres min')
                    ->badge()
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->suffix(' km')
                    ->formatStateUsing(fn($state) => number_format($state, 0)), // Affiche sans décimales
                TextColumn::make('kilometers_range_max')
                    ->label('Kilomètres max')
                    ->badge()
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->suffix(' km')
                    ->formatStateUsing(fn($state) => number_format($state, 0)), // Affiche sans décimales
                TextColumn::make('tariff')
                    ->label('Tarif')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->suffix(' €'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListZones::route('/'),
            'create' => Pages\CreateZone::route('/create'),
            'view' => Pages\ViewZone::route('/{record}'),
            'edit' => Pages\EditZone::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }
}
