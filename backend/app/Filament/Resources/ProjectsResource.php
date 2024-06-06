<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Models\Projects;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RyanChandler\FilamentProgressColumn\ProgressColumn;
use Illuminate\Support\Facades\Auth;
use App\Forms\Components\RangeSlider;

class ProjectsResource extends Resource
{

    protected static ?string $model = Projects::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('due_date'),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\FileUpload::make('image_path')
                    ->image(),
                Select::make('progress')
                    ->options([
                        '0' => '0%',
                        '10' => '10%',
                        '20' => '20%',
                        '30' => '30%',
                        '40' => '40%',
                        '50' => '50%',
                        '60' => '60%',
                        '70' => '70%',
                        '80' => '80%',
                        '90' => '90%',
                        '100' => '100%',
                    ])
                ,
                Forms\Components\Select::make('created_by')
                    ->required()
                    ->default(auth()->id())
                    ->disabled()
                    ->relationship('users', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user(); // Get the authenticated user
        $userId = $user->id; // Assuming 'id' is the user ID field in your user model

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($userId) {
                $query->where('created_by', $userId);
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\ImageColumn::make('image_path'),

                ProgressColumn::make('progress')
                    ->searchable()
                ,
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            'view' => Pages\ViewProjects::route('/{record}'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
        ];
    }
}
