<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Pengurus';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                            ->required()
                            ->label('Nama Lengkap'),
                    TextInput::make('email')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Email Aktif'),
                    TextInput::make('kelas')
                            ->required()
                            ->label('Kelas'),
                    TextInput::make('konselor')
                            ->required()
                            ->label('Konselor'),
                    TextInput::make('boarding_master')
                            ->required()
                            ->label('Boarding Master/Wali')
                            ->columnSpan(2),
                    Select::make('roles')
                            ->relationship('roles', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),
                    TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required()
                            ->minLength(8)
                            ->hiddenOn('edit')
                            ->rules(['confirmed']),
            
                    TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->hiddenOn('edit'),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->label('Nama Lengkap'),
                TextColumn::make('email')->searchable()->sortable()->label('Email Address'),
                TextColumn::make('kelas')->searchable()->label('Kelas'),
                TextColumn::make('konselor')->searchable()->label('Konselor'),
                TextColumn::make('boarding_master')->searchable()->label('Boarding Master'),
                TextColumn::make('roles.name')->label('Role')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
