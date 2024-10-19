<?php

namespace App\Filament\Resources\StatisticResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\StatisticResource;
use App\Filament\Resources\StatisticResource\Widgets\TicketChart;
use App\Filament\Resources\StatisticResource\Widgets\TicketByPriorityChart;

class ListStatistics extends ListRecords
{
    protected static string $resource = StatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TicketChart::class,
            TicketByPriorityChart::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // TicketChart::class,
        ];
    }
}
