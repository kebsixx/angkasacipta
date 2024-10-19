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
        return [
            Stat::make('Total Users', User::count())
                ->description('New User this month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1, 5, 9, 10, 20, 40])
                ->color('success'),
            Stat::make('Total Ticket', Ticket::count())
                ->description('New Ticket this month')
                ->descriptionIcon('heroicon-m-ticket', IconPosition::Before)
                ->chart([1, 5, 9, 10, 20, 40])
                ->color('info'),
        ];
    }
}
