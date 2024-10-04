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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationLabel = 'Salariés';

    protected static ?string $modelLabel = 'Salarié';

    protected static ?string $navigationGroup = 'Salariés & Chantiers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations personnelles')
                    ->columns(10)
                    ->schema([
                        TextInput::make('last_name')
                            ->label('Nom :')
                            ->required()
                            ->placeholder('Doe')
                            ->columnSpan(5),
                        TextInput::make('first_name')
                            ->label('Prénom :')
                            ->required()
                            ->placeholder('John')
                            ->columnSpan(5),
                        Select::make('archived')
                            ->label('Archivé :')
                            ->options([
                                false => 'Non',
                                true => 'Oui',
                            ])
                            ->columnSpan(2)
                            ->required()
                            ->visibleOn('edit')
                            ->default(false),
                    ])->columnSpan(1),
                Section::make('Informations contractuelles')
                    ->columns(7)
                    ->schema([
                        Select::make('status')
                            ->label('Statut :')
                            ->required()
                            ->options([
                                'OUVRIER' => 'OUVRIER',
                                'ETAM' => 'ETAM',
                                'INTERIMAIRE' => 'INTERIMAIRE',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'ETAM') {
                                    $set('contract', '37');
                                } else {
                                    $set('contract', null);
                                }
                            })
                            ->columnSpan(3),
                        TextInput::make('contract')
                            ->label('Type de contrat :')
                            ->required(fn ($get) => in_array($get('status'), ['OUVRIER', 'ETAM']))
                            ->numeric()
                            ->reactive()
                            ->suffix('heures')
                            ->placeholder('37')
                            ->disabled(fn ($get) => $get('status') === 'ETAM')
                            ->afterStateUpdated(function ($set, $get) {
                                if ($get('status') === 'ETAM') {
                                    $set('contract', '37');
                                }
                            })
                            ->columnSpan(2)
                            ->visible(fn ($get) => in_array($get('status'), ['OUVRIER', 'ETAM'])),
                        TextInput::make('monthly_salary')
                            ->label('Salaire mensuel :')
                            ->required(fn ($get) => in_array($get('status'), ['OUVRIER', 'ETAM']))
                            ->numeric()
                            ->step('0.01')
                            ->rules(['numeric', 'regex:/^\d+(\.\d{1,8})?$/'])
                            ->placeholder('1 398,69')
                            ->suffix('€')
                            ->columnSpan(2)
                            ->visible(fn ($get) => in_array($get('status'), ['OUVRIER', 'ETAM'])),
                        TextInput::make('hourly_rate')
                            ->label('Tarif horaire :')
                            ->required(fn ($get) => $get('status') === 'INTERIMAIRE')
                            ->numeric()
                            ->step('0.00000001')
                            ->rules(['numeric', 'regex:/^\d+(\.\d{1,8})?$/'])
                            ->placeholder('12.50')
                            ->suffix('€ / heure')
                            ->columnSpan(3)
                            ->visible(fn ($get) => $get('status') === 'INTERIMAIRE'),
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
                        'info' => 'INTERIMAIRE',
                    ])
                    ->formatStateUsing(function ($state) {
                        return $state === 'INTERIMAIRE' ? 'INTERIM' : $state;
                    })
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
                    ->label('Salaire/Mois')
                    ->colors([
                        'gray' => fn ($state): bool => true,
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->suffix(' €'),
                TextColumn::make('hourly_rate')
                    ->label('Taux Horaire')
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('hourly_rate_charged')
                    ->label('T/H Chargé')
                    ->badge()
                    ->colors([
                        'primary' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('hourly_basket_charged')
                    ->label('P/H Chargé')
                    ->badge()
                    ->colors([
                        'primary' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('basket_day')
                    ->label('Panier/H')
                    ->badge()
                    ->colors([
                        'primary' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->formatStateUsing(fn ($state) => number_format($state, 2))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('archived')
                    ->label('Dispo')
                    ->boolean() // Indique que cette colonne représente un état booléen (true/false)
                    ->trueIcon('heroicon-o-x-circle') // Icône pour "archivé"
                    ->falseIcon('heroicon-o-check-circle') // Icône pour "non archivé"
                    ->colors([
                        'danger' => fn ($state): bool => $state, // Couleur verte pour "non archivé"
                        'success' => fn ($state): bool =>! $state, // Couleur rouge pour "archivé"
                    ])
                    ->sortable()
                    ->toggleable() // Permet de masquer/afficher la colonne
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
