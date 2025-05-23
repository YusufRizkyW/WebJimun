<?php
namespace App\Filament\Resources\AntrianResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Antrian;

/**
 * @property Antrian $resource
 */
class AntrianTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
