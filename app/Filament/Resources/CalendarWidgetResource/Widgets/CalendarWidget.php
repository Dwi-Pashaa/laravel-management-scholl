<?php

namespace App\Filament\Resources\CalendarWidgetResource\Widgets;

use App\Filament\Resources\MettingResource;
use App\Models\Metting;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Saade\FilamentFullCalendar\Actions\CreateAction;
use Saade\FilamentFullCalendar\Actions\DeleteAction;
use Saade\FilamentFullCalendar\Actions\EditAction;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Metting::class;

    public function fetchEvents(array $fetchInfo): array
    {
        $events = Metting::query()
                    ->where('start_at', '>=', $fetchInfo['start'])
                    ->where('end_at', '<=', $fetchInfo['end'])
                    ->get()
                    ->map(
                        fn (Metting $metting) => [
                            'id' => $metting->id,
                            'title' => $metting->title . ' | ' . $metting->departement->name . '|' . Carbon::parse($metting->start_at)->format('H:i:s') . ' - ' . Carbon::parse($metting->end_at)->format('H:i:s'),
                            'start' => Carbon::parse($metting->start_at)->format('Y-m-d'),
                            'end' => Carbon::parse($metting->end_at)->format('Y-m-d'),
                            'url' => MettingResource::getUrl(name: 'index', parameters: ['record' => $metting]),
                            'shouldOpenUrlInNewTab' => false,
                        ]
                    )
                    ->all();
        return $events;
    }

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridMonth,dayGridWeek,today',
                'center' => 'title',
                'right' => 'prev,next',
            ],
            'initialView' => 'dayGridMonth',
        ];
    }

    protected function headerActions(): array
    {
        return [
            CreateAction::make()->label('Buat Rapat')->modalHeading('Buat Rapat Baru'),
        ];
    }

    protected function modalActions(): array
    {
        return [
            EditAction::make()->modalHeading('Edit Rapat'),
            DeleteAction::make(),
        ];
    }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('title')->label('Judul Rapat')->required(),

            Select::make('departements_id')
                    ->relationship('departement', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

            Grid::make()
                ->schema([
                    DateTimePicker::make('start_at')->label('Tanggal & Waktu Mulai')->required(),
                    DateTimePicker::make('end_at')->label('Tanggal & Waktu Selesai')->required(),
                ]),

            TinyEditor::make('notes')->label('Catatan')->required()
        ];
    }

}
