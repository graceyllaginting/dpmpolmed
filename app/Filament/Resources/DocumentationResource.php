<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentationResource\Pages;
use App\Filament\Resources\DocumentationResource\RelationManagers;
use App\Models\Documentation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;


class DocumentationResource extends Resource
{
    protected static ?string $model = Documentation::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-text';
    protected static ?string $navigationLabel = 'Dokumentasi Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship(name: 'kategori', titleAttribute: 'nama_kategori')
                    ->required(),

                TextInput::make('judul')->required(),

                Textarea::make('deskripsi'),

                FileUpload::make('file')->directory('documentations'),

                DatePicker::make('tanggal')->label('Tanggal Dokumentasi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('kategori.nama_kategori')->label('Kategori'),
            TextColumn::make('judul')->label('Judul'),
            TextColumn::make('tanggal')->label('Tanggal')->date('d M Y'),
            TextColumn::make('file')->label('File')
            ->url(fn ($record) => asset('storage/' . $record->file))
            ->openUrlInNewTab()
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentations::route('/'),
            'create' => Pages\CreateDocumentation::route('/create'),
            'edit' => Pages\EditDocumentation::route('/{record}/edit'),
        ];
    }
}
