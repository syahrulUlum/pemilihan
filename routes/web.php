<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PemilihanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'halaman'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');



Route::group(['middleware' => 'isAdmin'], function () {
    Route::resource('/pemilih/kelas', KelasController::class)->except(['show']);
    Route::resource('/pemilih/jurusan', JurusanController::class)->except(['show']);
    Route::resource('/pemilih/siswa', SiswaController::class)->except(['show']);
    Route::resource('/pemilih/staff', StaffController::class)->except(['show']);

    Route::resource('/calon/kategori', KategoriController::class)->except(['show']);
    Route::resource('/calon', CalonController::class)->except('show');

    Route::resource('/jadwal', JadwalController::class)->except('show');

    Route::get('/status', [StatusController::class, 'index']);
    Route::get('/status/siswa/{status}', [StatusController::class, 'siswa']);
    Route::get('/status/staff/{status}', [StatusController::class, 'staff']);
});

Route::group(['middleware' => ['auth:siswa,staff', 'isPemilih']], function () {
    Route::get('/pemilihan', [PemilihanController::class, 'index']);
    Route::post('/pemilihan/{jadwal}/{calon}', [PemilihanController::class, 'pilih']);
});


Route::group(['middleware' => 'auth:web,siswa,staff'], function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/hasil', [HasilController::class, 'index']);
    Route::get('/hasil/{hasil}', [HasilController::class, 'show']);

    Route::get('/pengaturan', [PengaturanController::class, 'index']);
    Route::put('/pengaturan/{pengaturan}', [PengaturanController::class, 'update']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
