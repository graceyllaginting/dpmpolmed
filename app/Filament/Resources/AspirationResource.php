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

                // Kolom tambahan: tanggal, waktu, tempat
                DatePicker::make('tanggal_pertemuan')
                    ->label('Tanggal Pertemuan')
                    ->reactive()
                    ->afterStateUpdated(fn($state, $set, $get) => $set('tanggapan', self::generateTemplate($state, $get('waktu_pertemuan'), $get('tempat_pertemuan')))),

                TimePicker::make('waktu_pertemuan')
                    ->label('Waktu Pertemuan')
                    ->reactive()
                    ->afterStateUpdated(fn($state, $set, $get) => $set('tanggapan', self::generateTemplate($get('tanggal_pertemuan'), $state, $get('tempat_pertemuan')))),

                TextInput::make('tempat_pertemuan')
                    ->label('Tempat Pertemuan')
                    ->reactive()
                    ->afterStateUpdated(fn($state, $set, $get) => $set('tanggapan', self::generateTemplate($get('tanggal_pertemuan'), $get('waktu_pertemuan'), $state))),

                Textarea::make('tanggapan')
                    ->label('Tanggapan Admin')
                    ->rows(6)
                    ->disabled()
                    ->required(),

                DatePicker::make('tanggal_kirim')
                    ->label('Tanggal Kirim'),
            ]);
    }

    public static function generateTemplate($tanggal, $waktu, $tempat): string
    {
        return "Dengan hormat, kami mengundang Saudara untuk hadir pada pertemuan yang akan dilaksanakan pada:\n\n" .
            "📅 Tanggal: " . ($tanggal ?? '-') . "\n" .
            "🕒 Waktu: " . ($waktu ?? '-') . "\n" .
            "📍 Tempat: " . ($tempat ?? '-') . "\n\n" .
            "Atas perhatian Saudara, kami ucapkan terima kasih.";
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
                TextColumn::make('tanggal_kirim')->label('Tanggal Kirim')->date('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
