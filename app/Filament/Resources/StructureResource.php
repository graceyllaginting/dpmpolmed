<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StructureResource\Pages;
use App\Models\Structure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class StructureResource extends Resource
{
    protected static ?string $model = Structure::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';
    protected static ?string $navigationLabel = 'Struktur Organisasi DPM';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_anggota')
                    ->required()
                    ->label('Nama Anggota')
                    ->maxLength(255),

                TextInput::make('jabatan')
                    ->required()
                    ->label('Jabatan')
                    ->maxLength(255),

                TextInput::make('bagian')
                    ->required()
                    ->label('Bagian')
                    ->maxLength(255),

                TextInput::make('prodi')
                    ->required()
                    ->label('Program Studi')
                    ->maxLength(255),

                TextInput::make('periode')
                    ->required()
                    ->label('Periode')
                    ->maxLength(50),

                FileUpload::make('foto')
                    ->image()
                    ->imagePreviewHeight('250')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                    ->label('Foto')
                    ->directory('struktur-foto')
                    ->disk('public')
                    ->required(),


            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_anggota')->label('Nama')->searchable(),
                TextColumn::make('jabatan')->label('Jabatan')->searchable(),
                ImageColumn::make('foto')->label('Foto')->circular(),
                TextColumn::make('periode')->label('Periode'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y - H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStructures::route('/'),
            'create' => Pages\CreateStructure::route('/create'),
            'edit' => Pages\EditStructure::route('/{record}/edit'),
        ];
    }
}


// Grace ini resrouce filament yang ada di migrasi tadi
// <?php

// namespace App\Filament\Resources;

// use App\Filament\Resources\StructureResource\Pages;
// use App\Models\Structure;
// use Filament\Forms;
// use Filament\Forms\Form;
// use Filament\Resources\Resource;
// use Filament\Tables;
// use Filament\Tables\Table;
// use Filament\Forms\Components\TextInput;
// use Filament\Forms\Components\FileUpload;
// use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Columns\ImageColumn;

// class StructureResource extends Resource
// {
//     protected static ?string $model = Structure::class;

//     protected static ?string $navigationIcon = 'heroicon-s-users';
//     protected static ?string $navigationLabel = 'Struktur Organisasi DPM';

//     public static function form(Form $form): Form
//     {
//         return $form
//             ->schema([
//                 TextInput::make('nama_anggota')
//                     ->required()
//                     ->label('Nama Anggota')
//                     ->maxLength(255),

//                 TextInput::make('jabatan')
//                     ->required()
//                     ->label('Jabatan')
//                     ->maxLength(255),

//                 TextInput::make('bagian')
//                     ->label('Bagian')
//                     ->maxLength(255),

//                 TextInput::make('prodi')
//                     ->label('Program Studi')
//                     ->maxLength(255),

//                 TextInput::make('periode')
//                     ->required()
//                     ->label('Periode')
//                     ->maxLength(50),

//                 FileUpload::make('foto')
//                     ->image()
//                     ->imagePreviewHeight('250')
//                     ->maxSize(10240) // 10 MB
//                     ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
//                     ->label('Foto')
//                     ->directory('struktur-foto')
//                     ->required(),
//             ]);
//     }

//     public static function table(Table $table): Table
//     {
//         return $table
//             ->columns([
//                 ImageColumn::make('foto')->label('Foto')->circular(),
//                 TextColumn::make('nama_anggota')->label('Nama')->searchable(),
//                 TextColumn::make('jabatan')->label('Jabatan')->searchable(),
//                 TextColumn::make('bagian')->label('Bagian'),
//                 TextColumn::make('prodi')->label('Prodi'),
//                 TextColumn::make('periode')->label('Periode'),
//                 TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y - H:i'),
//             ])
//             ->filters([])
//             ->actions([
//                 Tables\Actions\EditAction::make(),
//             ])
//             ->bulkActions([
//                 Tables\Actions\DeleteBulkAction::make(),
//             ]);
//     }

//     public static function getRelations(): array
//     {
//         return [];
//     }

//     public static function getPages(): array
//     {
//         return [
//             'index' => Pages\ListStructures::route('/'),
//             'create' => Pages\CreateStructure::route('/create'),
//             'edit' => Pages\EditStructure::route('/{record}/edit'),
//         ];
//     }
// }
