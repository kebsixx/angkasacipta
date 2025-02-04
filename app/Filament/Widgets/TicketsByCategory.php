<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Ticket;
use Filament\Widgets\ChartWidget;

class TicketsByCategory extends ChartWidget
{
    protected static ?string $heading = 'Tickets by Category';
    protected static string $color = 'warning';

    protected function getData(): array
    {
        // Ambil data jumlah tiket per kategori
        $ticketsByCategory = Ticket::query()
            ->join('categories', 'tickets.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category, COUNT(tickets.id) as total')
            ->where('tickets.created_at', '>=', Carbon::now()->subMonth()) // Filter 1 bulan terakhir
            ->groupBy('categories.name')
            ->get();

        // Pisahkan label dan datanya
        $labels = $ticketsByCategory->pluck('category')->toArray();
        $data = $ticketsByCategory->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Tickets per Category (Last Month)',
                    'data' => $data,
                    'backgroundColor' => '#ff6384', // Warna bar chart
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
