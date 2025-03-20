<?php

use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\RKAController;
use App\Http\Controllers\SertMahController;
use App\Http\Controllers\TaController;
use App\Http\Controllers\TorController;
use App\Http\Controllers\UndurDiriDoController;
use App\Models\Mahasiswa;
use App\Models\UndurDiriDo;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Route;

// UNDUR DIRI
Route::get('/undur_diri_do', [UndurDiriDoController::class, 'index'])->name('undur_diri_do.index');
Route::post('/undur-diri/store', [UndurDiriDoController::class, 'store'])->name('undur-diri.store');
Route::put('/undur-diri/{id}', [UndurDiriDoController::class, 'update'])->name('undur-diri.update');
Route::delete('/undur-diri/{id}', [UndurDiriDoController::class, 'destroy'])->name('undur-diri.destroy');
Route::get('/undur-diri/export', [UndurDiriDoController::class, 'exportUndurDiri'])->name('undur-diri.export');
// UNDUR DIRI

// MAHASISWA
Route::get('/mahasiswa', function () {
    $mahasiswas = Mahasiswa::all();
    $tahunAkademiks = TahunAkademik::all();
    return view('mahasiswa.index', compact('mahasiswas', 'tahunAkademiks'));
})->name('mahasiswa.index');

Route::get('/lihat_mahasiswa/{id_mahasiswa}', function ($id_mahasiswa) {
    $mahasiswa = Mahasiswa::where('id_mahasiswa', $id_mahasiswa)->firstOrFail();
    return view('mahasiswa.lihat', compact('mahasiswa'));
})->name('mahasiswa.lihat');

Route::post('/tambah_mahasiswa', [mahasiswaController::class, 'store'])->name('mahasiswa.store');

Route::post('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');

Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

Route::get('/mahasiswa/cari', [MahasiswaController::class, 'cari'])->name('mahasiswa.cari');

Route::get('/mahasiswa/filter', [MahasiswaController::class, 'filter'])->name('mahasiswa.filter');
// MAHASISWA

// ->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// TA
Route::get('/tugas_akhir', [TaController::class, 'index'])->name('tugas_akhir.index');
Route::post('/tugas_akhir/store', [TaController::class, 'store'])->name('tugas_akhir.store');
Route::put('/tugas_akhir/{id_ta}', [TaController::class, 'update'])->name('tugas_akhir.update');
Route::delete('/tugas_akhir/{id_ta}', action: [TaController::class, 'destroy'])->name('tugas_akhir.destroy');
Route::get('/tugas_akhir/export', [TaController::class, 'export'])->name('tugas_akhir.export');
//TA

// sertifikat mahasiswa
Route::get('/sertifikat', [SertMahController::class, 'index'])->name('sertifikat_mahasiswa.index');
Route::post('/sertifikat/store', [SertMahController::class, 'store'])->name('sertifikat_mahasiswa.store');
Route::get('/get-mahasiswa', [SertMahController::class, 'getMahasiswa'])->name('get_mahasiswa');
Route::get('/sertifikat/{id}/edit', 'SertifikatMahasiswaController@edit')->name('sertifikat_mahasiswa.edit');
Route::put('/sertifikat/{id}', 'SertifikatMahasiswaController@update')->name('sertifikat_mahasiswa.update');
Route::resource('sertifikat_mahasiswa', SertMahController::class);
// sertifikat mahasiswa

// magang
Route::resource('magang', MagangController::class);
Route::get('/magang/{id}/edit', [MagangController::class, 'edit'])->name('magang.edit');
Route::post('magang/{magang}/store-mahasiswa', [MagangController::class, 'storeMahasiswaMagang'])->name('magang.storeMahasiswaMagang');
Route::put('/magang/{magang}/mahasiswa/{mahasiswa}', [MagangController::class, 'updateMahasiswaMagang'])->name('magang.updateMahasiswaMagang');
Route::delete('/magang/{magang}/mahasiswa/{mahasiswa}', [MagangController::class, 'deleteMahasiswaMagang'])->name('magang.deleteMahasiswaMagang');
Route::get('/magang/{id}/search', [MagangController::class, 'searchMahasiswaMagang'])->name('magang.search');
Route::get('/magang/mahasiswa_magang', [MagangController::class, 'show'])->name('magang.mahasiswa_magang.show');
Route::post('/addmahasiswamagang', [MagangController::class, 'addmahasiswamagang'])->name('addmahasiswamagang');
// magang


//fajar
Route::get('/rka', [RKAController::class, 'index'])->name('rka.index');
Route::get('/rka/create', [RKAController::class, 'create'])->name('rka.create');
Route::post('/rka', [RKAController::class, 'store'])->name('rka.store');
Route::delete('/rka/delete/{id}', [RKAController::class, 'destroy'])->name('rka.destroy');
Route::get('/rka/edit/{id}', [RKAController::class, 'edit'])->name('rka.edit');
Route::put('rka/update/{id}', [RKAController::class, 'update'])->name('rka.update');

Route::get('/tor', [TorController::class, 'index'])->name('tor.index');
Route::delete('/tor/delete/{id}', [TorController::class, 'destroy'])->name('tor.destroy');
Route::post('/tor/edit', [TorController::class, 'update'])->name('tor.update');
Route::post('/tor', [TorController::class, 'store'])->name('tor.store');
//fajar
require __DIR__ . '/auth.php';
