<?php

namespace App\Filament\Resources\FileSharingResource\Pages;

use App\Filament\Resources\FileSharingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFileSharing extends EditRecord
{
    protected static string $resource = FileSharingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
