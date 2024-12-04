<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuatKompenController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PersonilAkademikController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajuanKompenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CariKompenController;
use App\Models\PengajuanKompenModel;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:personil,mahasiswa');

Route::middleware(['auth:personil,mahasiswa'])->group(function() {
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' =>'personilakademik'],function(){
    Route::get('/',[PersonilAkademikController::class,'index']);
    Route::post('/list',[PersonilAkademikController::class, 'list']);
    Route::get('/create_ajax', [PersonilAkademikController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
    Route::post('/ajax', [PersonilAkademikController::class, 'store_ajax']); // Menampilkan data level baru Ajax
    Route::get('/{id}/show_ajax', [PersonilAkademikController::class, 'show_ajax']); 
    Route::get('/{id}/edit_ajax', [PersonilAkademikController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
    Route::put('/{id}/update_ajax', [PersonilAkademikController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [PersonilAkademikController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
    Route::delete('/{id}/delete_ajax', [PersonilAkademikController::class, 'delete_ajax']); // Untuk hapus data level Ajax
});

// Route::group(['prefix' => 'notifikasi'],function():void{
//     Route::get('/',[NotifikasiController::class,'index']);
// });

Route::group(['prefix' => 'profile'],function():void{
    Route::get('/',[ProfileController::class,'index']);
});

Route::group(['prefix' => 'cari_kompen'],function():void{
    Route::get('/',[CariKompenController::class,'index']);
    Route::post('/list',[CariKompenController::class, 'list']);
    Route::get('/{id}/show_ajax', [CariKompenController::class, 'show_ajax']); 

});
Route::group(['prefix' =>'level'],function(){
    Route::get('/',[LevelController::class,'index']);
    Route::post('/list',[LevelController::class, 'list']);
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menampilkan data level baru Ajax
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data level Ajax
});

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

Route::group(['prefix' => 'prodi'], function(){
    Route::get('/', [ProdiController::class, 'index']);
    Route::post('/list', [ProdiController::class, 'list']);
    Route::get('/create_ajax', [ProdiController::class, 'create_ajax']);
    Route::post('/ajax', [ProdiController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [ProdiController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [ProdiController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [ProdiController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [ProdiController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'kompetensi'], function(){
    Route::get('/', [KompetensiController::class, 'index']);
    Route::post('/list', [KompetensiController::class, 'list']);
    Route::get('/create_ajax', [KompetensiController::class, 'create_ajax']);
    Route::post('/ajax', [KompetensiController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [KompetensiController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [KompetensiController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [KompetensiController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [KompetensiController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'jeniskompen'], function(){
    Route::get('/', [JenisController::class, 'index']);
    Route::post('/list', [JenisController::class, 'list']);
    Route::get('/create_ajax', [JenisController::class, 'create_ajax']);
    Route::post('/ajax', [JenisController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [JenisController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [JenisController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [JenisController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [JenisController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'kompen'], function(){
    Route::get('/', [BuatKompenController::class, 'index']);
    Route::post('/list', [BuatKompenController::class, 'list']);
    Route::get('/create_ajax', [BuatKompenController::class, 'create_ajax']);
    Route::post('/ajax', [BuatKompenController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax', [BuatKompenController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [BuatKompenController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [BuatKompenController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [BuatKompenController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [BuatKompenController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'pengajuankompen'], function(){
    Route::get('/', [PengajuanKompenController::class, 'index']);
    Route::post('/list', [PengajuanKompenController::class, 'list']);
    Route::post('/ajax', [PengajuanKompenModel::class, 'store_ajax']); // Menampilkan data level baru Ajax
    Route::get('/{id}/show_ajax', [PengajuanKompenController::class, 'show_ajax']); 
    Route::post('/update-status', [PengajuanKompenController::class, 'updateStatus'])->name('pengajuankompen.updateStatus');
});

});
