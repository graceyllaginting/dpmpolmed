<?php

namespace App\Filament\Widgets;

use App\Models\Aspiration;
use Filament\Widgets\TableWidget as Widget;
use Filament\Tables;
use Filament\Tables\Table;

class LatestAspirations extends Widget
{
    protected static ?string $heading = 'Aspirasi Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Aspiration::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_pengirim')
                    ->label('Pengirim'),

                Tables\Columns\TextColumn::make('isi_aspirasi')
                    ->label('Aspirasi'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i'),
            ]);
    }
}
