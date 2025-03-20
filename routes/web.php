<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UndurDiriDoController;
use App\Models\Mahasiswa;
use App\Models\UndurDiriDo;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/mahasiswa', function () {
    $mahasiswas = Mahasiswa::all();
    return view('mahasiswa.index', compact('mahasiswas'));
});
Route::get('/undur_diri_do', [UndurDiriDoController::class, 'index'])->name('undur_diri_do.index');
Route::post('/undur-diri/store', [UndurDiriDoController::class, 'store'])->name('undur-diri.store');
Route::put('/undur-diri/{id}', [UndurDiriDoController::class, 'update'])->name('undur-diri.update');
Route::delete('/undur-diri/{id}', [UndurDiriDoController::class, 'destroy'])->name('undur-diri.destroy');

// ->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// });

require __DIR__ . '/auth.php';
