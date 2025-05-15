<?php

namespace App\Filament\Resources\RiwayatResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiwayatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'nik' => 'required',
			'nama' => 'required',
			'tanggal_lahir' => 'required|date',
			'nomor_antrian' => 'required',
			'hadir_pada' => 'required',
			'foto_pemeriksaan' => 'required'
		];
    }
}
