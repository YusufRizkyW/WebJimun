<?php
namespace App\Filament\Resources\JadwalResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Jadwal;

/**
 * @property Jadwal $resource
 */
class JadwalTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return $this->resource->toArray();
        return [
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'keterangan' => $this->keterangan,
        ];
    }
}
