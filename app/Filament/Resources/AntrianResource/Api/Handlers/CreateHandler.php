<?php
namespace App\Filament\Resources\AntrianResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AntrianResource;
use App\Filament\Resources\AntrianResource\Api\Requests\CreateAntrianRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = AntrianResource::class;

    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Antrian
     *
     * @param CreateAntrianRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateAntrianRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}