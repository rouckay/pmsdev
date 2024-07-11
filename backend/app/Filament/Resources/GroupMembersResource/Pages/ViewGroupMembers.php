<?php

namespace App\Filament\Resources\GroupMembersResource\Pages;

use App\Filament\Resources\GroupMembersResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGroupMembers extends ViewRecord
{
    protected static string $resource = GroupMembersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
