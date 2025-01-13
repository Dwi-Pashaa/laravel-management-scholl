<x-filament-panels::page>
    <x-filament::card>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700" style="margin-bottom: 10px">Judul Rapat</label>
                <input
                    type="text"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-0 focus:ring-offset-0 disabled:opacity-50 bg-gray-50"
                    value="{{ $this->meeting->title }}"
                    disabled
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" style="margin-bottom: 10px">Departemen</label>
                <input
                    type="text"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-0 focus:ring-offset-0 disabled:opacity-50 bg-gray-50"
                    value="{{ $this->meeting->departement->name }}"
                    disabled
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" style="margin-bottom: 10px">Tanggal & Waktu Mulai</label>
                <input
                    type="text"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-0 focus:ring-offset-0 disabled:opacity-50 bg-gray-50"
                    value="{{ \Carbon\Carbon::parse($this->meeting->start_at)->translatedFormat('d F Y - H:i') }}"
                    disabled
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" style="margin-bottom: 10px">Tanggal & Waktu Selesai</label>
                <input
                    type="text"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-0 focus:ring-offset-0 disabled:opacity-50 bg-gray-50"
                    value="{{ \Carbon\Carbon::parse($this->meeting->end_at)->translatedFormat('d F Y - H:i') }}"
                    disabled
                />
            </div>
        </div>

        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700" style="margin-bottom: 10px">Catatan Rapat</label>
            <div class="block w-full rounded-lg border-gray-300 shadow-sm bg-gray-50 p-4">
                {!! $this->meeting->notes !!}
            </div>
        </div>
    </x-filament::card>

    {{ $this->table }}
</x-filament-panels::page>
