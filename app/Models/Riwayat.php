<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table = 'riwayats';
    protected $fillable = [
        'nik', 
        'nama',
        'tanggal_lahir',
        'nomor_antrian',
        'hadir_pada',
        'foto_pemeriksaan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'hadir_pada' => 'datetime',
    ];


}
