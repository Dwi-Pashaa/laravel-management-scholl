<?php

namespace App\Filament\Resources\MettingListResource\Pages;

use App\Filament\Resources\MettingListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMettingLists extends ListRecords
{
    protected static string $resource = MettingListResource::class;

    protected static ?string $title = 'Presensi Rapat';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
