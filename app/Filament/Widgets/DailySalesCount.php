<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailySalesCount extends LineChartWidget
{
    protected static ?string $heading = 'Penjualan per Hari (7 Hari Terakhir)';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '60s'; // Refresh otomatis setiap 60 detik

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay(); // 6 hari ke belakang + hari ini = 7 hari
        $endDate = Carbon::now()->endOfDay();

        // Ambil total transaksi per hari
        $results = DB::table('transactions')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->get();

        // Siapkan label tanggal
        $dates = [];
        $sales = [];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $formatted = $date->format('Y-m-d');
            $dates[] = $formatted;
            $sales[$formatted] = 0;
        }

        foreach ($results as $row) {
            $sales[$row->date] = $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => array_values($sales),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                ],
            ],
            'labels' => $dates,
        ];
    }
}
