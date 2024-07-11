<?php

namespace App\Filament\Resources\TaskAssignmentsResource\Pages;

use App\Filament\Resources\TaskAssignmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskAssignments extends EditRecord
{
    protected static string $resource = TaskAssignmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
