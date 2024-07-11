<?php

namespace App\Filament\Resources\FileSharingResource\Pages;

use App\Filament\Resources\FileSharingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFileSharings extends ListRecords
{
    protected static string $resource = FileSharingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
