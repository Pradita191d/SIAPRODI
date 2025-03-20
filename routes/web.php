<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IpkController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $mahasiswas = Mahasiswa::all();
    return view('mahasiswa.index', compact('mahasiswas'));
})->name('dashboard');
// ->middleware(['auth', 'verified'])->name('dashboard')
;

Route::get('/ipk', [IpkController::class, 'index'])->name('ipk.index');
Route::post('/ipk/input', [IpkController::class, 'inputIpk'])->name('ipk.input');
Route::put('/ipk/{id}', [IpkController::class, 'updateIpk'])->name('ipk.update');
Route::get('/ipk/{id}/edit', [IpkController::class, 'editIpk'])->name('ipk.edit');
Route::delete('/ipk/{id}', [IpkController::class, 'deleteIpk'])->name('ipk.delete');
Route::post('/input-ipk', [IpkController::class, 'inputIpk']);
Route::get('/ipk/rekapitulasi', [IpkController::class, 'getRekapitulasi'])->name('ipk.rekapitulasi');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
