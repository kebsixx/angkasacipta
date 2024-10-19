<?php

namespace App\Filament\Resources\TicketAssignedResource\Pages;

use App\Filament\Resources\TicketAssignedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketAssigned extends EditRecord
{
    protected static string $resource = TicketAssignedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
