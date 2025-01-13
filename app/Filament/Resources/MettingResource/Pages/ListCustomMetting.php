<?php

namespace App\Filament\Resources\MettingResource\Pages;

use App\Filament\Resources\MettingResource;
use Filament\Resources\Pages\Page;

class ListCustomMetting extends Page
{
    protected static string $resource = MettingResource::class;

    protected static string $view = 'filament.resources.metting-resource.pages.list-custom-metting';

    protected static ?string $title = 'Rapat';

    public static function getWidgets(): array
    {
        return [
            \App\Filament\Resources\CalendarWidgetResource\Widgets\CalendarWidget::class,
        ];
    }
}
