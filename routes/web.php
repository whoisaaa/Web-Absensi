<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    Route::get('/kelas/{kelas}/mahasiswa', [App\Http\Controllers\KelasMahasiswaController::class, 'index'])->name('kelas.mahasiswa.index');
    Route::post('/kelas/{kelas}/mahasiswa/angkatan', [App\Http\Controllers\KelasMahasiswaController::class, 'storeAngkatan'])->name('kelas.mahasiswa.storeAngkatan');
    Route::post('/kelas/{kelas}/mahasiswa', [App\Http\Controllers\KelasMahasiswaController::class, 'store'])->name('kelas.mahasiswa.store');
    Route::delete('/kelas/{kelas}/mahasiswa/{mahasiswa}', [App\Http\Controllers\KelasMahasiswaController::class, 'destroy'])->name('kelas.mahasiswa.destroy');

    Route::get('/kelas/{kelas}/pertemuan', [App\Http\Controllers\PertemuanController::class, 'index'])->name('kelas.pertemuan.index');
    Route::get('/kelas/{kelas}/rekap', [App\Http\Controllers\KelasController::class, 'rekap'])->name('kelas.rekap');
    Route::post('/kelas/{kelas}/pertemuan', [App\Http\Controllers\PertemuanController::class, 'store'])->name('kelas.pertemuan.store');
    Route::get('/kelas/{kelas}/pertemuan/{pertemuan}/edit', [App\Http\Controllers\PertemuanController::class, 'edit'])->name('pertemuan.edit');
    Route::put('/kelas/{kelas}/pertemuan/{pertemuan}', [App\Http\Controllers\PertemuanController::class, 'update'])->name('pertemuan.update');
    Route::delete('/kelas/{kelas}/pertemuan/{pertemuan}', [App\Http\Controllers\PertemuanController::class, 'destroy'])->name('pertemuan.destroy');

    Route::get('/kelas/{kelas}/pertemuan/{pertemuan}/absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('kelas.absensi.index');
    Route::post('/kelas/{kelas}/pertemuan/{pertemuan}/absensi', [App\Http\Controllers\AbsensiController::class, 'store'])->name('kelas.absensi.store');

    Route::get('/mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa/angkatan', [App\Http\Controllers\MahasiswaController::class, 'storeAngkatan'])->name('mahasiswa.angkatan.store');
    Route::get('/mahasiswa/angkatan/{tahun}/edit', [App\Http\Controllers\MahasiswaController::class, 'editAngkatan'])->name('mahasiswa.angkatan.edit');
    Route::put('/mahasiswa/angkatan/{tahun}', [App\Http\Controllers\MahasiswaController::class, 'updateAngkatan'])->name('mahasiswa.angkatan.update');
    Route::delete('/mahasiswa/angkatan/{tahun}', [App\Http\Controllers\MahasiswaController::class, 'destroyAngkatan'])->name('mahasiswa.angkatan.destroy');
    Route::get('/mahasiswa/angkatan/{angkatan}', [App\Http\Controllers\MahasiswaController::class, 'showAngkatan'])->name('mahasiswa.angkatan');
    Route::post('/mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{mahasiswa}/edit', [App\Http\Controllers\MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{mahasiswa}', [App\Http\Controllers\MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{mahasiswa}', [App\Http\Controllers\MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});
