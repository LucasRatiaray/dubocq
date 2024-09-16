<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeBasketZonesRelationManager extends RelationManager
{
    protected static string $relationship = 'employeeBasketZones';

    protected static ?string $title = 'Panier par zone';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('employee_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('employee_id')
            ->columns([
                Tables\Columns\TextColumn::make('zone.name')
                    ->label('Zone')
                    ->badge()
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->prefix('Zone ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee_basket_zone_charged')
                    ->label('Panier/H Chargé')
                    ->colors([
                        'warning' => fn ($state): bool => true, // Appliquer la couleur "warning" à toutes les valeurs
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee_basket_zone')
                    ->label('Panier/H')
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->sortable(),
            ])
            ->defaultSort('zone.name', 'asc') // Tri par ordre alphabétique croissant
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
