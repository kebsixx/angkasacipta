<?php

namespace App\Filament\Resources\ListTicketAssignedResource\Pages;

use App\Filament\Resources\ListTicketAssignedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListTicketAssigneds extends ListRecords
{
    protected static string $resource = ListTicketAssignedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
