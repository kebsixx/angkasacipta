<?php

namespace App\Filament\Resources\StatisticResource\Widgets;

use App\Models\Ticket;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class TicketByPriorityChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets by Priority';
    protected static ?string $pollingInterval = '10s';
    protected static ?string $maxHeight = '200px';
    protected static string $color = 'info';

    protected function getData(): array
    {
        // Hitung jumlah ticket berdasarkan priority
        $priorities = Ticket::selectRaw('priority, COUNT(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority');

        // Pastikan setiap prioritas ada (meskipun datanya 0)
        $labels = ['Low', 'Medium', 'High'];
        $data = collect($labels)->map(fn($label) => $priorities->get($label, 0));

        return [
            'datasets' => [
                [
                    'label' => 'Tickets by Priority',
                    'data' => $data,
                    'backgroundColor' => ['#FF6384', '#FFCE56', '#36A2EB'], // Warna untuk setiap kategori
                ],
            ],
            'labels' => $labels, // Label untuk Doughnut Chart
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,  // Untuk menampilkan legend
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => false, // Hilangkan angka di sumbu X
                ],
                'y' => [
                    'display' => false, // Hilangkan angka di sumbu Y
                ],
            ],
        ];
    }
}
