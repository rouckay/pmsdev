<?php

namespace App\Filament\Resources\TaskAssignmentsResource\Pages;

use App\Filament\Resources\TaskAssignmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTaskAssignments extends ViewRecord
{
    protected static string $resource = TaskAssignmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
