<?php

namespace App\Filament\Resources\FileSharingResource\Pages;

use App\Filament\Resources\FileSharingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFileSharing extends ViewRecord
{
    protected static string $resource = FileSharingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
