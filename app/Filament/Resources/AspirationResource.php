<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AspirationResource\Pages;
use App\Models\Aspiration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;

class AspirationResource extends Resource
{
    protected static ?string $model = Aspiration::class;

    protected static ?string $navigationIcon = 'heroicon-s-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'Aspirasi Mahasiswa ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_aspirasi')
                    ->label('Kode Aspirasi')
                    ->disabled(),

                TextInput::make('nama_pengirim')
                    ->label('Nama Pengirim')
                    ->required(),

                TextInput::make('nim')
                    ->label('NIM')
                    ->required(),

                TextInput::make('prodi')
                    ->label('Program Studi')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                Textarea::make('isi_aspirasi')
                    ->label('Isi Aspirasi')
                    ->required()
                    ->rows(5),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'ditanggapi' => 'Ditanggapi',
                        'selesai' => 'Selesai',
                    ])
                    ->default('pending'),

                Textarea::make('tanggapan')
                    ->label('Tanggapan Admin')
                    ->rows(6)
                    ->disabled()
                    ->required(),

                Textarea::make('balasan_mahasiswa')
                    ->label('Balasan Mahasiswa')
                    ->rows(5)
                    ->disabled()
                    ->visible(fn ($record) => $record && filled($record->balasan_mahasiswa))
                    ->columnSpanFull(),

                DatePicker::make('tanggal_kirim')
                    ->label('Tanggal Kirim'),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_aspirasi')->label('Kode'),
                TextColumn::make('nama_pengirim')->label('Nama')->searchable(),
                TextColumn::make('prodi')->label('Prodi'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Belum Ditanggapi',
                        'ditanggapi' => 'Sudah Ditanggapi',
                        'selesai' => 'Selesai',
                    })
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'gray',
                        'ditanggapi' => 'yellow',
                        'selesai' => 'green',
                        default => 'gray',
                    }),
                TextColumn::make('balasan_mahasiswa')
                    ->label('Balasan')
                    ->formatStateUsing(fn ($state) => $state ? '✅ Ada' : '❌ Belum')
                    ->badge()
                    ->limit(30)
                    ->wrap()
                    ->color(fn ($state) => $state ? 'green' : 'gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tanggal_kirim')->label('Tanggal Kirim')->date('d M Y'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('balasan_mahasiswa')
                    ->label('Balasan Mahasiswa')
                    ->trueLabel('Sudah Ada')
                    ->falseLabel('Belum Ada')
                    ->column('balasan_mahasiswa'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAspirations::route('/'),
            'create' => Pages\CreateAspiration::route('/create'),
            'edit' => Pages\EditAspiration::route('/{record}/edit'),

        ];
    }
}
