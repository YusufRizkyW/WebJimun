<?php

namespace App\Filament\Resources\RiwayatResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\RiwayatResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\RiwayatResource\Api\Transformers\RiwayatTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = RiwayatResource::class;

    // public static bool $public = true;


    /**
     * Show Riwayat
     *
     * @param Request $request
     * @return RiwayatTransformer
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

        return new RiwayatTransformer($query);
    }
}
