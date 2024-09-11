<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationLabel = 'Tous les salariés';

    protected static ?string $modelLabel = 'Salarié';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations personnelles')
                    ->columns(1)
                    ->schema([
                        TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->placeholder('Nom'),
                        TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->placeholder('Prénom'),
                    ])->columnSpan(1),
                Section::make('Informations contractuelles')
                    ->columns(1)
                    ->schema([
                        Select::make('status')
                            ->label('Statut')
                            ->required()
                            ->options([
                                'OUVRIER' => 'OUVRIER',
                                'ETAM' => 'ETAM',
                            ]),
                        Select::make('contract')
                            ->label('Contrat')
                            ->required()
                            ->options([
                                '37H' => '37H',
                                '35H' => '35H',
                            ]),
                    ])->columnSpan(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Statut')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('contract')
                    ->label('Contrat')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('hourly_rate')
                    ->label('Taux Horaire')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('basket')
                    ->label('Panier')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
