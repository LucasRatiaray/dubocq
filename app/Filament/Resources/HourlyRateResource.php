<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HourlyRateResource\Pages;
use App\Filament\Resources\HourlyRateResource\RelationManagers;
use App\Models\HourlyRate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HourlyRateResource extends Resource
{
    protected static ?string $model = HourlyRate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('employeeId')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('zoneId')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('rate')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('start'),
                Forms\Components\DatePicker::make('end'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employeeId')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('zoneId')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListHourlyRates::route('/'),
            'create' => Pages\CreateHourlyRate::route('/create'),
            'view' => Pages\ViewHourlyRate::route('/{record}'),
            'edit' => Pages\EditHourlyRate::route('/{record}/edit'),
        ];
    }
}
