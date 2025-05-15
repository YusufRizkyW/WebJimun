<?php

namespace App\Filament\Resources\JadwalResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\JadwalResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\JadwalResource\Api\Transformers\JadwalTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = JadwalResource::class;

    public static bool $public = true;


    /**
     * Show Jadwal
     *
     * @param Request $request
     * @return JadwalTransformer
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

        return new JadwalTransformer($query);
    }
}
