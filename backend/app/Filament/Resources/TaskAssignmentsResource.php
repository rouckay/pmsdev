<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskAssignmentsResource\Pages;
use App\Filament\Resources\TaskAssignmentsResource\RelationManagers;
use App\Models\TaskAssignments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskAssignmentsResource extends Resource
{
    protected static ?string $model = TaskAssignments::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Tasks';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskAssignments::route('/'),
            'create' => Pages\CreateTaskAssignments::route('/create'),
            'view' => Pages\ViewTaskAssignments::route('/{record}'),
            'edit' => Pages\EditTaskAssignments::route('/{record}/edit'),
        ];
    }
}
