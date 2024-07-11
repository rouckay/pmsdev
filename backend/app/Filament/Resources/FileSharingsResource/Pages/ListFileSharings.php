<?php

namespace App\Filament\Resources\FileSharingsResource\Pages;

use App\Filament\Resources\FileSharingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFileSharings extends ListRecords
{
    protected static string $resource = FileSharingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
