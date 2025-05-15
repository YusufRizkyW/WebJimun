<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/tes-upload', function () {
    return <<<HTML
    <form method="POST" enctype="multipart/form-data" action="/tes-upload">
        <input type="file" name="foto">
        <button type="submit">Upload</button>
    </form>
HTML;
});

Route::post('/tes-upload', function (Request $request) {
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('riwayat-foto', 'public');
        return "Berhasil upload: <a href='/storage/{$path}'>Lihat Gambar</a>";
    }
    return "Gagal upload!";

});

Route::get('/', function () {
    return view('welcome');
});
