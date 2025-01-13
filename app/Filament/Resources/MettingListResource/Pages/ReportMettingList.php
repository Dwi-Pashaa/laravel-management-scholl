<?php

namespace App\Filament\Resources\MettingListResource\Pages;

use App\Filament\Resources\MettingListResource;
use App\Models\DepartementUser;
use App\Models\MeetingAttendance;
use App\Models\Metting;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ButtonAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class ReportMettingList extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = MettingListResource::class;

    protected static string $view = 'filament.resources.metting-list-resource.pages.report-metting-list';

    protected static ?string $title = 'Presensi Rapat - ';

    public Metting $meeting;

    public function mount($record): void
    {
        $this->meeting = Metting::findOrFail($record);
        static::$title .= $this->meeting->title;
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(DepartementUser::where('departments_id', $this->meeting->departements_id))
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Pengurus')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email Pengurus')
                    ->searchable(),
                TextColumn::make('user.kelas')
                    ->label('Kelas')
                    ->searchable(),
                TextColumn::make('user.konselor')
                    ->label('Konselor')
                    ->searchable(),

                BadgeColumn::make('status_absensi')
                    ->label('Presensi')
                    ->getStateUsing(function ($record) {
                        $attendance = $record->user->attendances->where('mettings_id', $this->meeting->id)->first();
                        if ($attendance) {
                            return $attendance->status; 
                        }
                        return 'Belum melakukan absensi';
                    })
                    ->colors([
                        'success' => 'Hadir',
                        'danger' => 'Tidak Hadir',
                        'info' => 'Belum melakukan absensi',
                    ])
            ])
            ->filters([
            ])
            ->actions([
                
            ])
            ->bulkActions([
                BulkAction::make('bulkInsertHadir')
                    ->label('Presensi Hadir')
                    ->icon('heroicon-o-plus')
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            MeetingAttendance::updateOrCreate(
                                [
                                    'mettings_id' => $this->meeting->id,
                                    'users_id' => $record->user->id,
                                ],
                                [
                                    'status' => 'Hadir'
                                ]
                            );
                        }

                        Notification::make()
                            ->title('Presensi Hadir Berhasil')
                            ->success()
                            ->body(count($records) . ' pengguna telah berhasil ditandai sebagai hadir.')
                            ->send();
                    })
                    ->requiresConfirmation(),

                BulkAction::make('bulkInsertTidakHadir')
                    ->label('Presensi Tidak Hadir')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            MeetingAttendance::updateOrCreate(
                                [
                                    'mettings_id' => $this->meeting->id,
                                    'users_id' => $record->user->id,
                                ],
                                [
                                    'status' => 'Tidak Hadir'
                                ]
                            );
                        }

                        Notification::make()
                            ->title('Presensi Tidak Hadir Berhasil')
                            ->success()
                            ->body(count($records) . ' pengguna telah berhasil ditandai sebagai tidak hadir.')
                            ->send();
                    })
                    ->requiresConfirmation(),
            ]);
    }

    protected function getActions(): array
    {
        return [
            \Filament\Actions\Action::make('downloadPDF')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-on-square-stack')
                ->color('danger')
                ->url(fn () => route('generate.presensi.pdf', $this->meeting->id))
                ->openUrlInNewTab(),
        ];
    }
}

