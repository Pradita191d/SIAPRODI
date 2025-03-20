<?php

use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\ProfileController;
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

// });

require __DIR__ . '/auth.php';
