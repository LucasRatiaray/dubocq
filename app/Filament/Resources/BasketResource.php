<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BasketResource\Pages;
use App\Filament\Resources\BasketResource\RelationManagers;
use App\Models\Basket;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BasketResource extends Resource
{
    protected static ?string $model = Basket::class;

    protected static ?string $navigationIcon = 'heroicon-m-archive-box';

    protected static ?string $navigationLabel = 'Panier';

    protected static ?string $modelLabel = 'Panier';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Panier')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('basket')
                            ->label('Valeur :')
                            ->suffix('€')
                            ->numeric()
                            ->step('0.01')
                            ->required(),
                    ])->columnSpan(1), // Cette section occupe 1/4 de la largeur
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('basket')
                    ->label('Panier')
                    ->badge()
                    ->colors([
                        'success' => fn ($state): bool => true, // Appliquer la couleur "info" à toutes les valeurs
                    ])
                    ->sortable()
                    ->suffix(' €'),
                TextColumn::make('basket_charged')
                    ->label('Panier Chargé')
                    ->sortable()
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
/*                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBaskets::route('/'),
            //'create' => Pages\CreateBasket::route('/create'),
            'view' => Pages\ViewBasket::route('/{record}'),
            'edit' => Pages\EditBasket::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }
}
