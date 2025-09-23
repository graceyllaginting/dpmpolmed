<?php

namespace App\Filament\Resources\AspirationResource\Pages;

use App\Filament\Resources\AspirationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;

class ListAspirations extends ListRecords
{
    protected static string $resource = AspirationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // 🟡 Tambahkan ini untuk membuat tombol "Lihat Tanggapan" di setiap baris tabel
    protected function getTableActions(): array
    {
        return [
            Action::make('lihat_tanggapan')
                ->label('Lihat Tanggapan')
                ->icon('heroicon-m-eye')
                ->modalHeading('Tanggapan Aspirasi')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup')
                ->modalContent(fn ($record) => view('components.modal-tanggapan', [
                    'tanggapan' => $record->tanggapan,
                ])),
        ];
    }
}
