<?php

namespace App\Filament\Resources\TaskAssignmentsResource\Pages;

use App\Filament\Resources\TaskAssignmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskAssignments extends ListRecords
{
    protected static string $resource = TaskAssignmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
