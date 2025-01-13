<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MettingResource\Pages;
use App\Filament\Resources\MettingResource\RelationManagers;
use App\Models\Metting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MettingResource extends Resource
{
    protected static ?string $model = Metting::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Pengumuman & Rapat';

    protected static ?string $navigationLabel = 'Rapat';

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomMetting::route('/'),
        ];
    }
}
