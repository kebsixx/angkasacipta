<?php

namespace App\Filament\Exports;

use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;

class TicketExporter extends Exporter
{
    protected static ?string $model = Ticket::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID Ticket'),
            ExportColumn::make('created_at')
                ->label('Date'),
            ExportColumn::make('office.name')
                ->label('Office'),
            ExportColumn::make('location.name')
                ->label('Location'),
            ExportColumn::make('category.name')
                ->label('Category'),
            ExportColumn::make('subcategory.name')
                ->label('Subcategory'),
            ExportColumn::make('subject'),
            ExportColumn::make('updated_at')
                ->label('Last Updated'),
        ];
    }

    public function getFormats(): array
    {
        return [
            ExportFormat::Csv,
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        Log::info('Notifikasi ekspor dijalankan'); // Debugging log

        $body = 'Your ticket export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
