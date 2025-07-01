<?php

namespace App\Filament\Resources\AspirationResource\Pages;

use App\Filament\Resources\AspirationResource;
use App\Models\Invitation;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Carbon;

class EditAspiration extends EditRecord
{
    protected static string $resource = AspirationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('tanggapan')
                ->label('Tanggapan Langsung')
                ->nullable()
                ->default(null),

            Forms\Components\Select::make('status')
                ->label('Status Tanggapan')
                ->options([
                    'pending' => 'Belum Ditanggapi',
                    'ditanggapi' => 'Sudah Ditanggapi',
                    'selesai' => 'Selesai',
                ])
                ->required(),

            Forms\Components\Toggle::make('butuh_undangan')
                ->label('Apakah butuh pertemuan/undangan?')
                ->reactive()
                ->default(false),

            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Pertemuan')
                ->visible(fn ($get) => $get('butuh_undangan'))
                ->nullable()
                ->reactive()
                ->afterStateUpdated(fn ($set, $get) => $this->generateIsiUndangan($set, $get)),

            Forms\Components\TimePicker::make('waktu')
                ->label('Waktu Pertemuan')
                ->visible(fn ($get) => $get('butuh_undangan'))
                ->nullable()
                ->reactive()
                ->afterStateUpdated(fn ($set, $get) => $this->generateIsiUndangan($set, $get)),

            Forms\Components\TextInput::make('tempat')
                ->label('Tempat Pertemuan')
                ->visible(fn ($get) => $get('butuh_undangan'))
                ->nullable()
                ->reactive()
                ->afterStateUpdated(fn ($set, $get) => $this->generateIsiUndangan($set, $get)),

            Forms\Components\Textarea::make('isi_undangan')
                ->label('Isi Undangan')
                ->visible(fn ($get) => $get('butuh_undangan'))
                ->disabled()
                ->dehydrated(false),
        ]);
    }

    protected function generateIsiUndangan($set, $get): void
    {
        $tanggal = $get('tanggal') ? Carbon::parse($get('tanggal'))->translatedFormat('d F Y') : '...';
        $waktu   = $get('waktu') ?? '...';
        $tempat  = $get('tempat') ?? '...';

        $template = "DPM mengundang Anda untuk menghadiri pertemuan pada:\n\n"
                  . "📅 Tanggal: {$tanggal}\n"
                  . "🕒 Waktu: {$waktu}\n"
                  . "📍 Tempat: {$tempat}\n\n"
                  . "Harap hadir tepat waktu. Terima kasih.";

        $set('isi_undangan', $template);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Field undangan tidak disimpan ke table aspirations
        unset($data['butuh_undangan'], $data['isi_undangan'], $data['tanggal'], $data['waktu'], $data['tempat']);
        return $data;
    }

    protected function saved(): void
    {
        $data = $this->form->getState();

        // Hapus undangan lama jika ada
        Invitation::where('id_aspirasi', $this->record->id)->delete();

        // Jika form aktifkan undangan
        if (
            $data['butuh_undangan'] &&
            $data['tanggal'] &&
            $data['waktu'] &&
            $data['tempat']
        ) {
            Invitation::updateOrCreate([
                'id_aspirasi' => $this->record->id,
                'isi_undangan' => $data['isi_undangan'],
                'tanggal' => Carbon::parse($data['tanggal']),
                'waktu' => $data['waktu'],
                'tempat' => $data['tempat'],
                'status_konfirmasi' => 'pending',
            ]);
        }
    }
}
