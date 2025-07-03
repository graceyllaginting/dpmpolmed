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
                ->columnSpan('full'),

            Forms\Components\Select::make('status')
                ->label('Status Tanggapan')
                ->options([
                    'pending' => 'Belum Ditanggapi',
                    'ditanggapi' => 'Sudah Ditanggapi',
                    'selesai' => 'Selesai',
                ])
                ->required(),

            Forms\Components\Toggle::make('butuh_undangan')
                ->label('Butuh Undangan Pertemuan?')
                ->reactive(),

            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Pertemuan')
                ->visible(fn ($get) => $get('butuh_undangan')),

            Forms\Components\TimePicker::make('waktu')
                ->label('Waktu Pertemuan')
                ->visible(fn ($get) => $get('butuh_undangan')),

            Forms\Components\TextInput::make('tempat')
                ->label('Tempat Pertemuan')
                ->visible(fn ($get) => $get('butuh_undangan')),
        ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Buang data undangan dari table aspirations
        unset($data['butuh_undangan'], $data['tanggal'], $data['waktu'], $data['tempat']);
        return $data;
    }

    protected function saved(): void
    {
        $data = $this->form->getState();

        // Pastikan hanya jika toggle aktif dan data lengkap
        if ($data['butuh_undangan'] && $data['tanggal'] && $data['waktu'] && $data['tempat']) {

            // Cek apakah undangan untuk aspirasi ini sudah ada
            $existingInvitation = Invitation::where('id_aspirasi', $this->record->id)->first();

            $payload = [
                'tanggal' => $data['tanggal'],
                'waktu' => $data['waktu'],
                'tempat' => $data['tempat'],
                'status_konfirmasi' => 'pending', // bisa diubah jika ada workflow konfirmasi
            ];

            if ($existingInvitation) {
                $existingInvitation->update($payload);
            } else {
                // Tambahkan ID aspirasi
                $payload['id_aspirasi'] = $this->record->id;
                Invitation::create($payload);
            }
        } else {
            // Jika toggle dimatikan → hapus undangan (opsional)
            Invitation::where('id_aspirasi', $this->record->id)->delete();
        }
    }

}
