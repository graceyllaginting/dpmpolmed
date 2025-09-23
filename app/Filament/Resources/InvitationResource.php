<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvitationResource\Pages;
use App\Models\Invitation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class InvitationResource extends Resource
{
    protected static ?string $model = Invitation::class;

    protected static ?string $navigationIcon = 'heroicon-s-envelope-open';
    protected static ?string $navigationLabel = 'Undangan Aspirasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('id_aspirasi')
                ->label('Kode Aspirasi')
                ->relationship('aspiration', 'kode_aspirasi')
                ->searchable()
                ->required()
                ->disabled(fn () => request()->has('aspiration_id')), // jika ada di URL, disable


            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Pertemuan')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                    self::updateIsiUndangan($set, $get)
                ),

            Forms\Components\TimePicker::make('waktu')
                ->label('Waktu Pertemuan')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                    self::updateIsiUndangan($set, $get)
                ),

            Forms\Components\TextInput::make('tempat')
                ->label('Tempat Pertemuan')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                    self::updateIsiUndangan($set, $get)
                ),

            Forms\Components\Textarea::make('isi_undangan')
                ->label('Isi Undangan (Otomatis)')
                ->rows(6)
                ->disabled()
                ->dehydrated(false), // <- penting! supaya tidak dikirim ke DB via form
                // karena sudah disimpan oleh model di booted()

            Forms\Components\Select::make('status_konfirmasi')
                ->label('Status Konfirmasi')
                ->options([
                    'pending' => 'Belum Dikonfirmasi',
                    'diterima' => 'Diterima',
                    'ditolak' => 'Ditolak',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('aspiration.kode_aspirasi')
                    ->label('Kode Aspirasi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('waktu')
                    ->label('Waktu'),

                Tables\Columns\TextColumn::make('tempat')
                    ->label('Tempat'),

                Tables\Columns\BadgeColumn::make('status_konfirmasi')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'diterima',
                        'danger' => 'ditolak',
                    ])
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'pending' => 'Belum Dikonfirmasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                        default => 'Tidak Diketahui',
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected static function updateIsiUndangan(callable $set, callable $get): void
    {
        $tanggal = $get('tanggal');
        $waktu = $get('waktu');
        $tempat = $get('tempat');

        if ($tanggal && $waktu && $tempat) {
            $tanggalFormatted = Carbon::parse($tanggal)->translatedFormat('d F Y');
            $waktuFormatted = Carbon::parse($waktu)->format('H:i');

            $isi = "Halo! Terima kasih telah menyampaikan aspirasi Anda. "
                . "Untuk menindaklanjuti hal tersebut, kami mengundang Anda untuk hadir dalam pertemuan bersama tim DPM:\n\n"
                . "📅 Tanggal: {$tanggalFormatted}\n"
                . "🕒 Waktu: {$waktuFormatted}\n"
                . "📍 Tempat: {$tempat}\n\n"
                . "Mari berdiskusi dan mencari solusi bersama. Kehadiran Anda sangat berarti bagi kami!";

            $set('isi_undangan', $isi);
        }
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvitations::route('/'),
            'create' => Pages\CreateInvitation::route('/create'),
            'edit' => Pages\EditInvitation::route('/{record}/edit'),
        ];
    }

    
}
