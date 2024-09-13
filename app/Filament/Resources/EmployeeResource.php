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
use Filament\Tables\Columns\BadgeColumn;
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
                            ->label('Nom :')
                            ->required()
                            ->placeholder('Doe'),
                        TextInput::make('first_name')
                            ->label('Prénom :')
                            ->required()
                            ->placeholder('John'),
                    ])->columnSpan(1),
                Section::make('Informations contractuelles')
                    ->columns(7)  // Divise la section en 7 colonnes
                    ->schema([
                        Select::make('status')
                            ->label('Statut :')
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
                            ->columnSpan(3),  // Occupe 3 colonnes
                        TextInput::make('contract')
                            ->label('Type de contrat :')
                            ->required()
                            ->numeric()
                            ->placeholder('37')
                            ->reactive()
                            ->suffix('heures') // Ajouter le suffixe "heures" après la saisie
                            ->disabled(fn ($get) => $get('status') === 'ETAM')  // Désactiver la saisie si ETAM est sélectionné
                            ->afterStateUpdated(function ($set, $get) {
                                if ($get('status') === 'ETAM') {
                                    $set('contract', '37');
                                }
                            })
                            ->columnSpan(2),  // Occupe 2 colonnes
                        TextInput::make('monthly_salary')
                            ->label('Salaire mensuel :')
                            ->required()
                            ->numeric()
                            ->step('0.01')
                            ->placeholder('1 398,69')
                            ->suffix('€')
                            ->columnSpan(2),  // Occupe 2 colonnes
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
                    ->badge()
                    ->colors([
                        'success' => 'OUVRIER',
                        'danger' => 'ETAM',
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('contract')
                    ->label('Contrat')
                    ->badge()
                    ->colors([
                        'warning' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->suffix('h'),
                TextColumn::make('monthly_salary')
                    ->label('Salaire Mensuel')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->suffix(' €'),
                TextColumn::make('hourly_rate')
                    ->label('Taux Horaire')
                    ->badge()
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('hourly_rate_charged')
                    ->label('Taux/H Chargé')
                    ->badge()
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('hourly_basket_charged')
                    ->label('Panier/H Chargé')
                    ->badge()
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('basket')
                    ->label('Panier')
                    ->badge()
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
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
            RelationManagers\EmployeeBasketZonesRelationManager::class,
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

    public static function getNavigationSort(): ?int
    {
        return 1;
    }
}
