<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
       use HasFactory;
    protected $table = 'antrians';
    protected $fillable = [
        'nik', 
        'nama',
        'tanggal_lahir',
        'nomor_antrian',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    protected static function booted()
    {
        static::creating(function ($antrian) {
            $tanggalHariIni = now()->toDateString();
    
            $lastAntrian = self::whereDate('created_at', $tanggalHariIni)
                ->orderByDesc('nomor_antrian')
                ->first();
    
            $antrian->nomor_antrian = $lastAntrian ? $lastAntrian->nomor_antrian + 1 : 1;
        });
    }
}
