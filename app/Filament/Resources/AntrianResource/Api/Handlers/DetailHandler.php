<?php

namespace App\Filament\Resources\AntrianResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\AntrianResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\AntrianResource\Api\Transformers\AntrianTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = AntrianResource::class;

    public static bool $public = true;


    /**
     * Show Antrian
     *
     * @param Request $request
     * @return AntrianTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new AntrianTransformer($query);
    }
}
