<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Transaction;
use Carbon\Carbon;

class A_TodayRevenueCard extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        $today = Carbon::today();

        $revenueToday = Transaction::whereDate('created_at', $today)
            ->sum('total');

        $transactionCountToday = Transaction::whereDate('created_at', $today)
            ->count();

        return [
            Card::make('Pendapatan Hari Ini', 'Rp ' . number_format($revenueToday, 0, ',', '.'))
                ->color('success'),

            Card::make('Jumlah Transaksi Hari Ini', $transactionCountToday)
                ->color('primary'),
        ];
    }
}
