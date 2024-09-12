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

    protected static ?string $navigationLabel = 'Salariés';

    protected static ?string $modelLabel = 'Salarié';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations personnelles')
                    ->columns(2)
                    ->schema([
                        TextInput::make('last_name')
                            ->label('Nom:')
                            ->required()
                            ->placeholder('Doe'),
                        TextInput::make('first_name')
                            ->label('Prénom:')
                            ->required()
                            ->placeholder('John'),
                    ])->columnSpan(1),
                Section::make('Informations contractuelles')
                    ->columns(4)  // Divise la section en 3 colonnes
                    ->schema([
                        Select::make('status')
                            ->label('Statut:')
                            ->required()
                            ->options([
                                'OUVRIER' => 'OUVRIER',
                                'ETAM' => 'ETAM',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'ETAM') {
                                    $set('contract', '37');
                                } elseif ($state === 'OUVRIER') {
                                    $set('contract', '37');
                                } else {
                                    $set('contract', null); // Remet à null si aucun statut n'est sélectionné
                                }
                            })
                            ->columnSpan(2),  // Occupe une colonne
                        TextInput::make('contract')
                            ->label('Type de contrat:')
                            ->required()
                            ->placeholder('37')
                            ->reactive()
                            ->suffix('heures') // Ajouter le suffixe "heures" après la saisie
                            ->disabled(fn ($get) => $get('status') === 'ETAM')  // Désactiver la saisie si ETAM est sélectionné
                            ->afterStateUpdated(function ($set, $get) {
                                if ($get('status') === 'ETAM') {
                                    $set('contract', '37');
                                }
                            })
                            ->columnSpan(1),  // Occupe une colonne
                        TextInput::make('monthly_salary')
                            ->label('Salaire mensuel:')
                            ->required()
                            ->placeholder('1 398,69')
                            ->suffix('€')
                            ->columnSpan(1),  // Occupe une colonne
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
                    ->toggleable()
                    ->formatStateUsing(fn (string $state): string => $state . ' H'),
                TextColumn::make('monthly_salary')
                    ->label('Salaire Mensuel')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->formatStateUsing(fn (string $state): string => $state . ' €'),
                TextColumn::make('hourly_rate_charged')
                    ->label('Taux Horaire Chargé')
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
