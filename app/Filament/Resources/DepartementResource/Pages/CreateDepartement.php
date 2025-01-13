<?php

namespace App\Filament\Resources\DepartementResource\Pages;

use App\Filament\Resources\DepartementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDepartement extends CreateRecord
{
    protected static string $resource = DepartementResource::class;

    protected static ?string $title = 'Tambah';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Berhasil Menyimpan Data';
    }
}
