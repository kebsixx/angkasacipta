<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;

class TicketsByStatus extends ChartWidget
{
    protected static ?string $heading = 'Tickets by Status';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Ambil data ticket berdasarkan status dan hitung jumlahnya
        $ticketsByStatus = Ticket::select('status')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Tickets by Status',
                    'data' => array_values($ticketsByStatus),
                    'backgroundColor' => [
                        '#FF6384', // Warna untuk status pertama
                        '#36A2EB', // Warna untuk status kedua
                    ],
                ],
            ],
            'labels' => array_keys($ticketsByStatus), // Status akan jadi label di chart
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
