<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\TransactionItems;
use App\Models\Foods;

class TopSellingProductsChart extends BarChartWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Produk Terlaris';

    protected function getData(): array
    {
        $topProducts = TransactionItems::selectRaw('foods_id, SUM(quantity) as total_quantity')
            ->groupBy('foods_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $labels = [];
        $data = [];

        foreach ($topProducts as $product) {
            $food = Foods::find($product->foods_id);
            $labels[] = $food ? $food->name : 'Unknown';
            $data[] = $product->total_quantity;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Terjual',
                    'data' => $data,
                    'backgroundColor' => '#2563eb', // biru
                ],
            ],
        ];
    }
}
