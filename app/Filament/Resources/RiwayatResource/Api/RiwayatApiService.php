<?php
namespace App\Filament\Resources\RiwayatResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\RiwayatResource;
use Illuminate\Routing\Router;


class RiwayatApiService extends ApiService
{
    protected static string | null $resource = RiwayatResource::class;

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
