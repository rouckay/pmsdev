<?php
namespace App\Filament\Resources\ProjectsResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ProjectsResource;
use Illuminate\Routing\Router;


class ProjectsApiService extends ApiService
{
    protected static string | null $resource = ProjectsResource::class;

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
