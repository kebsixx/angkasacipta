<?php

namespace App\Filament\Resources\StatisticResource\Widgets;

use App\Models\Ticket;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class TicketChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets';
    protected static ?string $pollingInterval = '10s';
    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $data = Trend::model(Ticket::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('id');

        return [
            'datasets' => [
                [
                    'label' => 'Ticket',
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
