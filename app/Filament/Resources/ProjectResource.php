<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations générales')
                    ->columns(1)
                    ->schema([
                        TextInput::make('code')
                            ->label('Code chantier')
                            ->required()
                            ->placeholder('Code'),
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
                        TextInput::make('kilometers')
                            ->label('Distance en km')
                            ->required()
                            ->placeholder('Distance'),
                    ])->columnSpan(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Code chantier')
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
                TextColumn::make('kilometers')
                    ->label('Distance en km')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('zone.name')
                    ->label('Zone')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
