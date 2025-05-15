<?php
namespace App\Filament\Resources\RiwayatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\RiwayatResource;
use App\Filament\Resources\RiwayatResource\Api\Requests\CreateRiwayatRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = RiwayatResource::class;

    // public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Riwayat
     *
     * @param CreateRiwayatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateRiwayatRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}