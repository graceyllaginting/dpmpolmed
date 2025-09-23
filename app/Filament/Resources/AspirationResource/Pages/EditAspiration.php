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

        ]);
    }

}