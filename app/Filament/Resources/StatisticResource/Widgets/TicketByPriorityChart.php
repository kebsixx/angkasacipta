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
        $data = Trend::model(Ticket::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count('priority');

        return [
            'datasets' => [
                [
                    'label' => 'Priority',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
