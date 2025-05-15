<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->integer('nomor_antrian');
            $table->timestamp('hadir_pada')->nullable(); // waktu hadir
            $table->string('foto_pemeriksaan')->nullable(); // tambahkan kolom foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
