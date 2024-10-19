<?php

namespace App\Filament\Resources\TicketAssignedResource\Pages;

use App\Filament\Resources\TicketAssignedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketAssigneds extends ListRecords
{
    protected static string $resource = TicketAssignedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
