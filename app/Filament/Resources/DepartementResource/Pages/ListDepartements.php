<?php

namespace App\Filament\Resources\DepartementResource\Pages;

use App\Filament\Resources\DepartementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepartements extends ListRecords
{
    protected static string $resource = DepartementResource::class;

    protected static ?string $title = 'Data Departement';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah'),
        ];
    }
}
