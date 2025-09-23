<?php

namespace App\Filament\Resources\InvitationResource\Pages;

use App\Filament\Resources\InvitationResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateInvitation extends CreateRecord
{
    protected static string $resource = InvitationResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('id_aspirasi') // disesuaikan
                ->label('Kode Aspirasi')
                ->relationship('aspiration', 'kode_aspirasi') // relasi model 'aspiration' harus disesuaikan juga
                ->default(fn () => request()->get('aspiration_id'))
                ->disabled()
                ->dehydrated(false) // <== nilai ini tidak akan dikirim ke database
                ->required(),

            Forms\Components\Textarea::make('isi_undangan')
                ->label('Isi Undangan')
                ->required(),

            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Pertemuan')
                ->required(),

            Forms\Components\TimePicker::make('waktu')
                ->label('Waktu Pertemuan')
                ->required(),

            Forms\Components\TextInput::make('tempat')
                ->label('Tempat')
                ->required(),
        ];
    }

protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_aspirasi'] = request()->get('aspiration_id'); // ambil dari query
        return $data;
    }


}
