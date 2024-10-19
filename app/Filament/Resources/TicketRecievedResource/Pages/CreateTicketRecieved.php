<?php

namespace App\Filament\Resources\TicketRecievedResource\Pages;

use App\Filament\Resources\TicketRecievedResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketRecieved extends CreateRecord
{
    protected static string $resource = TicketRecievedResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
