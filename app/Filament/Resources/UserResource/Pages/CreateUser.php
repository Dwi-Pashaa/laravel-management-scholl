<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Tambah';

    protected function afterSave()
    {
        $user = $this->record;

        $roles = $this->form->getState()['roles'];

        if ($roles) {
            $user->syncRoles($roles);
        }
    }
}
