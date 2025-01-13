<?php

namespace App\Filament\Resources\MettingResource\Pages;

use App\Filament\Resources\MettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMettings extends ListRecords
{
    protected static string $resource = MettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
