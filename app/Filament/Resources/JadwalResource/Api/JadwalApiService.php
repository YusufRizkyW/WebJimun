<?php
namespace App\Filament\Resources\JadwalResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\JadwalResource;
use Illuminate\Routing\Router;


class JadwalApiService extends ApiService
{
    protected static string | null $resource = JadwalResource::class;

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
