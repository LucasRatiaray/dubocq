<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-m-rocket-launch';

    protected static ?string $navigationLabel = 'Chantiers';

    protected static ?string $modelLabel = 'Chantier';

    protected static ?string $navigationGroup = 'Salariés & Chantiers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(5) // Divise la ligne en 5 parts égales
                ->schema([
                    Section::make('Code')
                        ->schema([
                            TextInput::make('code')
                                ->label('Code chantier')
                                ->required()
                                ->placeholder('Code'),
                        ])->columnSpan(1), // 1/5 de la largeur

                    Section::make('Informations Générales')
                    ->columns(3)
                    ->schema([
                        TextInput::make('business')
                            ->label('Affaire')
                            ->required()
                            ->placeholder('Affaire'),
                        TextInput::make('city')
                            ->label('Ville chantier')
                            ->required()
                            ->placeholder('Ville'),
                        TextInput::make('address')
                            ->label('Adresse chantier')
                            ->required()
                            ->placeholder('Adresse'),
                    ])->columnSpan(3), // 3/5 de la largeur

                    Section::make('Zone')
                        ->schema([
                            TextInput::make('kilometers')
                                ->label('Distance en km')
                                ->required()
                                ->suffix('km')
                                ->numeric()
                                ->step('0.01')
                                ->placeholder('Distance'),
                        ])->columnSpan(1), // 1/5 de la largeur
                    Section::make('')
                        ->columns(1)
                        ->schema([
                            Select::make('archived')
                                ->label('Archivé :')
                                ->options([
                                    false => 'Non',
                                    true => 'Oui',
                                ])
                                ->required()
                                ->default(false)
                                ->columnSpan(2),
                        ])->columnSpan(1)->visibleOn('edit'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->badge()
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('business')
                    ->label('Affaire')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('address')
                    ->label('Adresse chantier')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('city')
                    ->label('Ville chantier')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('kilometers')
                    ->label('Distance')
                    ->badge()
                    ->colors([
                        'warning' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->extraAttributes(['class' => 'large-badge'])
                    ->searchable()
                    ->sortable()
                    ->suffix(' km')
                    ->toggleable(),
                TextColumn::make('zone.name')
                    ->label('Zone')
                    ->badge()
                    ->colors([
                        'info' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->searchable()
                    ->sortable()
                    ->prefix('Zone ')
                    ->toggleable(),
                TextColumn::make('archived')
                    ->label('Statut')
                    ->formatStateUsing(function ($state) {
                        return $state ? 'Archivé' : 'En cours';
                    })
                    ->badge()
                    ->colors([
                        'success' => fn ($state): bool => !$state, // Couleur pour "Fini"
                        'danger' => fn ($state): bool => $state, // Couleur pour "En cours"
                    ])
                    ->sortable()
                    ->toggleable()
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }
}
