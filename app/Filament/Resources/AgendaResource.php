<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Agenda Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')->required()->label('Judul Kegiatan'),
                Textarea::make('deskripsi')->label('Deskripsi')->rows(4),
                DatePicker::make('tanggal')->required()->label('Tanggal Kegiatan'),
                TimePicker::make('waktu')->label('Waktu'),
                TextInput::make('tempat')->label('Tempat'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->searchable()->sortable()->label('Judul'),
                TextColumn::make('tanggal')->date('d M Y')->sortable()->label('Tanggal'),
                TextColumn::make('waktu')->label('Waktu'),
                TextColumn::make('tempat')->label('Tempat'),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),

        ];
    }
}
