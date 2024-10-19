<?php

namespace App\Filament\Resources\TicketRecievedResource\Pages;

use App\Filament\Resources\TicketRecievedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketRecieveds extends ListRecords
{
    protected static string $resource = TicketRecievedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
