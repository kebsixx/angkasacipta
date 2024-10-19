<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;

class TicketsBySubCategory extends ChartWidget
{
    protected static ?string $heading = 'Tickets by Sub Category';
    protected static string $color = 'warning';

    protected function getData(): array
    {
        // Ambil data jumlah tiket per kategori
        $ticketsByCategory = Ticket::query()
            ->join('sub_categories', 'tickets.category_id', '=', 'sub_categories.id')
            ->selectRaw('sub_categories.name as subcategory, COUNT(tickets.id) as total')
            ->groupBy('sub_categories.name')
            ->get();

        // Pisahkan label dan datanya
        $labels = $ticketsByCategory->pluck('subcategory')->toArray();
        $data = $ticketsByCategory->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Tickets per Sub Category',
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
