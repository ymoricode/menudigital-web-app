<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class MonthlyRevenueChart extends LineChartWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Pendapatan Bulanan';

    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;

        $labels = [];
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = Carbon::create($currentYear, $month)->format('M');
            $monthlyRevenue = Transaction::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->sum('total');
            $data[] = $monthlyRevenue;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data,
                    'fill' => true,
                    'borderColor' => '#22c55e', // hijau
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                ],
            ],
        ];
    }
}
