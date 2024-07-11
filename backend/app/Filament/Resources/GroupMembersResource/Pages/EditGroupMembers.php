<?php

namespace App\Filament\Resources\GroupMembersResource\Pages;

use App\Filament\Resources\GroupMembersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGroupMembers extends EditRecord
{
    protected static string $resource = GroupMembersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
