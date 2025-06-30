<?php

namespace App\Filament\Widgets;

use App\Models\Aspiration;
use App\Models\Documentation;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Aspirasi Masuk', Aspiration::count())
                ->description('Jumlah semua aspirasi yang masuk')
                ->descriptionColor('danger')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('gray'),

            Card::make('Total Dokumentasi', Documentation::count())
                ->description('Jumlah dokumentasi kegiatan')
                ->descriptionColor('primary')
                ->icon('heroicon-o-camera')
                ->color('gray'),

            Card::make('Total Kategori', Category::count())
                ->description('Kategori aspirasi atau dokumentasi')
                ->descriptionColor('success')
                ->icon('heroicon-o-tag')
                ->color('gray'),
        ];
        
    }
    
    
}

