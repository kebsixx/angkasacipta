<?php

namespace App\Filament\Resources\TicketRecievedResource\Pages;

use App\Filament\Resources\TicketRecievedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketRecieved extends EditRecord
{
    protected static string $resource = TicketRecievedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
