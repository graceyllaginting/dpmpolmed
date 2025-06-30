<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VisitorStats extends BarChartWidget
{
    protected static ?string $heading = 'Statistik Pengunjung Website';

    protected function getData(): array
    {
        $data = collect(range(0, 6))->map(function ($daysAgo) {
            return [
                'date' => now()->subDays($daysAgo)->format('Y-m-d'),
                'count' => DB::table('visitors')
                    ->whereDate('visited_at', now()->subDays($daysAgo))
                    ->count(),
            ];
        })->reverse()->values();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengunjung',
                    'data' => $data->pluck('count'),
                    'backgroundColor' => '#9400d3', // warna orange
                ],
            ],
            'labels' => $data->pluck('date'),
        ];
    }
}
