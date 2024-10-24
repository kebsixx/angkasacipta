<?php

namespace App\Filament\Widgets;

use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use function Livewire\before;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $completedStatuses = ['100%', 'done', 'completed', 'selesai'];

        $onProgressCount = Ticket::whereNotIn('progress', $completedStatuses)->count();

        return [
            Stat::make('Total Users', User::count())
                ->description('New User this month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1, 5, 9, 10, 20, 40])
                ->color('info'),
            Stat::make('Total Ticket', Ticket::count())
                ->description('New Ticket this month')
                ->descriptionIcon('heroicon-m-ticket', IconPosition::Before)
                ->chart([1, 5, 9, 10, 20, 40])
                ->color('info'),
            Stat::make('On Progress', $onProgressCount)
                ->description('On Progress this month')
                ->descriptionIcon('heroicon-m-clock', IconPosition::Before)
                ->chart([1, 5, 9, 10, 20, 70])
                ->color('info'),
        ];
    }
}
