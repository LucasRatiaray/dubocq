<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use BladeUI\Icons\Components\Icon;
use Filament\Forms;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-user-circle';

    public static ?string $label = 'Utilisateurs';

    public static function canViewAny(): bool
    {
        return auth()->user()->can('viewAny', User::class);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create', User::class);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->can('update', $record);
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->can('delete', $record);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->placeholder('John Doe'),
                TextInput::make('firstname')
                    ->label('Prénom')
                    ->required()
                    ->placeholder('John'),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->placeholder('john@example.com'),
                Select::make('roles')
                    ->label('Rôles')
                    ->relationship('roles', 'name')  // Spécifie la relation many-to-many avec la table Role
                    ->options(Role::all()->pluck('name', 'id')) // Charge tous les rôles disponibles depuis la table roles
                    ->multiple()
                    ->placeholder('Sélectionner les rôles')
                    ->required(),
                TextInput::make('password')
                    ->label('Mot de passe')
                    ->password()
                    ->nullable()  // Rendre le champ nullable
                    ->dehydrateStateUsing(fn ($state) => $state ? bcrypt($state) : null)  // Hash le mot de passe uniquement s'il est soumis
                    ->placeholder('*********')
                    ->required(fn ($record) => !$record)  // Obligatoire seulement à la création
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('firstname')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles')
                    ->label('Rôles')
                    ->formatStateUsing(function ($state, $record) {
                        return $record->roles->pluck('name')->join(', ');
                    })
                    ->sortable(),
                TextColumn::make('last_login_at')
                    ->label('Dernière connexion')
                    ->date('d/m/Y H:i')
                    ->sortable(),
                IconColumn::make('is_online')
                    ->label('Connecté')
                    ->boolean()
                    ->getStateUsing(fn (User $record) => $record->isOnline())
                    ->color(fn ($state): string => $state ? 'success' : 'secondary')
                    ->tooltip(fn ($state): string => $state ? 'En ligne' : 'Hors ligne'),
            ])
            ->filters([
                //
            ])
            ->actions([
/*                Tables\Actions\ViewAction::make(),*/
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
