<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MettingListResource\Pages;
use App\Filament\Resources\MettingListResource\Pages\ReportMettingList;
use App\Filament\Resources\MettingListResource\RelationManagers;
use App\Models\Metting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MettingListResource extends Resource
{
    protected static ?string $model = Metting::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Pengumuman & Rapat';

    protected static ?string $navigationLabel = 'Presensi Rapat';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul Rapat')->searchable(),
                TextColumn::make('departement.name')->label('Departement')->searchable(),
                TextColumn::make('start_at')
                            ->label('Tanggal & Waktu Mulai')
                            ->formatStateUsing(function ($state) {
                                return \Carbon\Carbon::parse($state)->translatedFormat('d F Y H:i:s');
                            }),
                TextColumn::make('end_at')
                            ->label('Tanggal & Waktu Selesai')
                            ->formatStateUsing(function ($state) {
                                return \Carbon\Carbon::parse($state)->translatedFormat('d F Y H:i:s');
                            }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('reports')
                    ->label('Presensi')
                    ->url(fn ($record) => ReportMettingList::getUrl(['record' => $record->id]))
                    ->icon('heroicon-o-document')
                    ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListMettingLists::route('/'),
            'reports' => Pages\ReportMettingList::route('/{record}/reports'),
        ];
    }
}
