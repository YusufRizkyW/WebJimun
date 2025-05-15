<?php
namespace App\Filament\Resources\AntrianResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AntrianResource;
use App\Filament\Resources\AntrianResource\Api\Requests\UpdateAntrianRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = AntrianResource::class;

    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Antrian
     *
     * @param UpdateAntrianRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateAntrianRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}