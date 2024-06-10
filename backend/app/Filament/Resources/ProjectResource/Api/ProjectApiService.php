<?php
namespace App\Filament\Resources\ProjectResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ProjectResource;
use Illuminate\Routing\Router;


class ProjectApiService extends ApiService
{
    protected static string | null $resource = ProjectResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
