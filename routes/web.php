<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MagangController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $mahasiswas = Mahasiswa::all();
    return view('mahasiswa.index', compact('mahasiswas'));
});
// ->middleware(['auth', 'verified'])->name('dashboard')
;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
// Route::middleware(['auth'])->group(function () {
    Route::resource('magang', MagangController::class);
    Route::get('/magang/{id}/edit', [MagangController::class, 'edit'])->name('magang.edit');
    Route::post('magang/{magang}/store-mahasiswa', [MagangController::class, 'storeMahasiswaMagang'])->name('magang.storeMahasiswaMagang');
    Route::put('/magang/{magang}/mahasiswa/{mahasiswa}', [MagangController::class, 'updateMahasiswaMagang'])->name('magang.updateMahasiswaMagang');
    Route::delete('/magang/{magang}/mahasiswa/{mahasiswa}', [MagangController::class, 'deleteMahasiswaMagang'])->name('magang.deleteMahasiswaMagang');
    Route::get('/magang/{id}/search', [MagangController::class, 'searchMahasiswaMagang'])->name('magang.search');
    Route::get('/magang/mahasiswa_magang', [MagangController::class, 'show'])->name('magang.mahasiswa_magang.show');
    Route::post('/addmahasiswamagang', [MagangController::class, 'addmahasiswamagang'])->name('addmahasiswamagang');

// });

require __DIR__.'/auth.php';
