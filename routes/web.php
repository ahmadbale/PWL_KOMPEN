<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\TambahTugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\VerifikasiTugasController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KategoriController;



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


// Route::get('login', [AuthController::class, 'login'])->name('login');
// Route::post('login', [AuthController::class, 'postlogin']);
// Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/tugas', [TugasController::class, 'index']);
Route::get('/history', [HistoryController::class, 'index']);
Route::get('/progres', [ProgresController::class, 'index']);
Route::get('/notifikasi', [NotifikasiController::class, 'index']);
Route::get('/verifikasitugas', [VerifikasiTugasController::class, 'index']);
Route::get('/verifikasi', [VerifikasiController::class, 'index']);
Route::get('/tambahtugas', [TambahTugasController::class, 'index']);
Route::get('/tambahdosen', [DosenController::class, 'index']);
Route::get('/tambahtendik', [TendikController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);

Route::group(['prefix' => 'mahasiswa'], function () {
Route::get('/', [MahasiswaController::class, 'index']);
Route::post('/list', [MahasiswaController::class, 'list']);
Route::get('/create_ajax', [MahasiswaController::class, 'create_ajax']);
Route::post('/ajax', [MahasiswaController::class, 'store_ajax']);
Route::get('/{id}/edit_ajax', [MahasiswaController::class, 'edit_ajax']);
Route::put('/{id}/update_ajax', [MahasiswaController::class, 'update_ajax']);
Route::get('/{id}/show_ajax', [MahasiswaController::class, 'show_ajax']);
Route::get('/{id}/delete_ajax', [MahasiswaController::class, 'confirm_ajax']);
Route::delete('/{id}/delete_ajax', [MahasiswaController::class, 'delete_ajax']);
Route::get('/import',[MahasiswaController::class,'import']);
Route::post('/import_ajax',[MahasiswaController::class,'import_ajax']);
Route::get('/export_excel',[MahasiswaController::class,'export_excel']);
});

Route::group(['prefix' =>'level'],function(){
    Route::get('/',[LevelController::class,'index']);
    Route::post('/list',[LevelController::class, 'list']);
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menampilkan data level baru Ajax
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); 
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data level Ajax
});
