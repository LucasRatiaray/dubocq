<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NonWorkingDayResource\Pages;
use App\Filament\Resources\NonWorkingDayResource\RelationManagers;
use App\Models\NonWorkingDay;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NonWorkingDayResource extends Resource
{
    protected static ?string $model = NonWorkingDay::class;

    protected static ?string $navigationIcon = 'heroicon-o-x-circle';

    protected static ?string $navigationLabel = 'Jour non travaillé';

    protected static ?string $modelLabel = 'Jour non travaillé';

    protected static ?string $navigationGroup = 'Fériés & Fermetures';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Jour non travaillé')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('date')
                            ->label('Date')
                            ->required()
                            ->required(),
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'Férié' => 'Férié',
                                'Fermerture' => 'Fermerture',
                            ])
                            ->required()
                            ->placeholder('Choisir une option'),
                    ])->columnSpan(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        // Utiliser Carbon pour formater la date
                        return Carbon::parse($state)->translatedFormat('l d F Y');
                    }),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->colors([
                        'success' => fn($state): bool => $state === 'Férié',
                        'warning' => fn($state): bool => $state === 'Fermerture',
                    ])
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListNonWorkingDays::route('/'),
            'create' => Pages\CreateNonWorkingDay::route('/create'),
            'view' => Pages\ViewNonWorkingDay::route('/{record}'),
            'edit' => Pages\EditNonWorkingDay::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 6;
    }
}
