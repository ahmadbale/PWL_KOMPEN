<?php
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuatKompenController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CariKompenController;
use App\Http\Controllers\HistoryKompenController;
use App\Http\Controllers\HistoryKompenSelesaiController;
use App\Http\Controllers\HistoryKompenMahasiswaSelesaiController;
use App\Http\Controllers\HistoryKompenMahasiswaController;
use App\Http\Controllers\HistoryKompenMahasiswaTolakController;
use App\Http\Controllers\KompetensiMahasiswaController;
use App\Http\Controllers\PersonilAkademikController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajuanKompenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TolakKompenController;
use App\Models\PengajuanKompenModel;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\ProfilePersonilController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:personil,mahasiswa');

Route::middleware(['auth:personil,mahasiswa'])->group(function() {
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/dashboard-admin', [WelcomeController::class, 'index_admin']);

Route::group(['prefix' =>'personilakademik', 'middleware'=>'authorize:ADM'],function(){
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

Route::group(['prefix' =>'level', 'middleware'=>'authorize:ADM'],function(){
    Route::get('/',[LevelController::class,'index']);
    Route::post('/list',[LevelController::class, 'list']);
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menampilkan data level baru Ajax
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data level Ajax
});

Route::group(['prefix' => 'mahasiswa', 'middleware'=>'authorize:ADM'], function () {
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

Route::group(['prefix' => 'prodi', 'middleware'=>'authorize:ADM'], function(){
    Route::get('/', [ProdiController::class, 'index']);
    Route::post('/list', [ProdiController::class, 'list']);
    Route::get('/create_ajax', [ProdiController::class, 'create_ajax']);
    Route::post('/ajax', [ProdiController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [ProdiController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [ProdiController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [ProdiController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [ProdiController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'kompetensi', 'middleware'=>'authorize:ADM'], function(){
    Route::get('/', [KompetensiController::class, 'index']);
    Route::post('/list', [KompetensiController::class, 'list']);
    Route::get('/create_ajax', [KompetensiController::class, 'create_ajax']);
    Route::post('/ajax', [KompetensiController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [KompetensiController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [KompetensiController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [KompetensiController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [KompetensiController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'jeniskompen', 'middleware'=>'authorize:ADM'], function(){
    Route::get('/', [JenisController::class, 'index']);
    Route::post('/list', [JenisController::class, 'list']);
    Route::get('/create_ajax', [JenisController::class, 'create_ajax']);
    Route::post('/ajax', [JenisController::class, 'store_ajax']);
    Route::get('/{id}/edit_ajax', [JenisController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [JenisController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [JenisController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [JenisController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'kompen', 'middleware'=>'authorize:ADM,DSN,TDK'], function(){
    Route::get('/', [BuatKompenController::class, 'index']);
    Route::post('/list', [BuatKompenController::class, 'list']);
    Route::get('/create_ajax', [BuatKompenController::class, 'create_ajax']);
    Route::post('/ajax', [BuatKompenController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax', [BuatKompenController::class, 'show_ajax']); 
    Route::post('/update-status', [BuatKompenController::class, 'updateStatus'])->name('kompen.updateStatus');
});

Route::group(['prefix' => 'pengajuankompen', 'middleware'=>'authorize:ADM,DSN,TDK'], function(){
    Route::get('/', [PengajuanKompenController::class, 'index']);
    Route::post('/list', [PengajuanKompenController::class, 'list']);//list Pengajuan
    Route::post('/list_kompen',[PengajuanKompenController::class, 'list_kompen']);//link
    Route::post('/ajax', [PengajuanKompenModel::class, 'store_ajax']); // Menampilkan data level baru Ajax
    Route::get('/{id}/show_ajax', [PengajuanKompenController::class, 'show_ajax']); 
    Route::post('/update-status', [PengajuanKompenController::class, 'updateStatus'])->name('pengajuankompen.updateStatus');
});

Route::group(['prefix' => 'cari_kompen', 'middleware'=>'authorize:MHS'],function():void{
    Route::get('/',[CariKompenController::class,'index']);
    Route::post('/list',[CariKompenController::class, 'list']);
    Route::post('/ajukan_ajax', [CariKompenController::class, 'ajukankompen']);
    Route::get('/{id}/show_ajax', [CariKompenController::class, 'show_ajax']); 
    Route::post('/ajukan_kompen', [CariKompenController::class, 'store_pengajuan'])->name('ajukan.kompen');
});

Route::group(['prefix' => 'tolak_kompen', 'middleware'=>'authorize:ADM,DSN,TDK'],function():void{
    Route::get('/',[TolakKompenController::class,'index']);
    Route::post('/list',[TolakKompenController::class, 'list']);
    Route::get('/{id}/show_ajax', [TolakKompenController::class, 'show_ajax']); 
});

//History Dosen
Route::group(['prefix' => 'histori_kompen', 'middleware'=>'authorize:ADM,DSN,TDK'], function(){
    Route::get('/', [HistoryKompenController::class, 'index']);
    Route::post('/list_kompen', [HistoryKompenController::class, 'list_kompen']);
    Route::post('/list', [HistoryKompenController::class, 'list']);
    Route::get('/{id}/show_ajax', [HistoryKompenController::class, 'show_ajax']);
    Route::post('/update-status', [HistoryKompenController::class, 'updateStatus'])->name('histori_kompen.updateStatus');
    Route::post('/update-kompen-selesai', [HistoryKompenController::class, 'updateKompenSelesai'])->name('update-kompen-selesai');

});

//History Mahasiswa
Route::group(['prefix' => 'histori_mahasiswa', 'middleware'=>'authorize:MHS'], function(){
    Route::get('/', [HistoryKompenMahasiswaController::class, 'index'])->name('histori_mahasiswa.index');
    Route::post('/list_kompen', [HistoryKompenMahasiswaController::class, 'list_kompen']);
    Route::post('/list', [HistoryKompenMahasiswaController::class, 'list']);
    Route::get('/{id}/show_ajax', [HistoryKompenMahasiswaController::class, 'show_ajax']);
    // Route::get('/{id}/show_tugas_ajax', [HistoryKompenMahasiswaController::class, 'show_tugas_ajax']);
    Route::put('/{id}/updateProgres', [HistoryKompenMahasiswaController::class, 'updateProgres'])->name('histori_mahasiswa.updateProgres');
});

Route::group(['prefix' => 'histori_mahasiswa_selesai', 'middleware'=>'authorize:MHS'], function(){
    Route::get('/', [HistoryKompenMahasiswaSelesaiController::class, 'index'])->name('histori_mahasiswa.index');
    Route::post('/list_kompen', [HistoryKompenMahasiswaSelesaiController::class, 'list_kompen']);
    Route::post('/list', [HistoryKompenMahasiswaSelesaiController::class, 'list']);
    Route::get('/{id}/show_ajax', [HistoryKompenMahasiswaSelesaiController::class, 'show_ajax']);
    Route::put('/{id}/updateProgres', [HistoryKompenMahasiswaSelesaiController::class, 'updateProgres'])->name('histori_mahasiswa.updateProgres');
    Route::get('/{id}/export_pdf', [HistoryKompenMahasiswaSelesaiController::class, 'export_pdf']);    
});

Route::group(['prefix' => 'histori_mahasiswa_tolak', 'middleware'=>'authorize:MHS'], function(){
    Route::get('/', [HistoryKompenMahasiswaTolakController::class, 'index'])->name('histori_mahasiswa.index');
    Route::post('/list_kompen', [HistoryKompenMahasiswaTolakController::class, 'list_kompen']);
    Route::post('/list', [HistoryKompenMahasiswaTolakController::class, 'list']);
    Route::get('/{id}/show_ajax', [HistoryKompenMahasiswaTolakController::class, 'show_ajax']);
    Route::put('/{id}/updateProgres', [HistoryKompenMahasiswaTolakController::class, 'updateProgres'])->name('histori_mahasiswa.updateProgres');
});

Route::group(['prefix' => 'histori_selesai', 'middleware'=>'authorize:ADM,DSN,TDK'], function(){
    Route::get('/', [HistoryKompenSelesaiController::class, 'index']);
    Route::post('/list_kompen', [HistoryKompenSelesaiController::class, 'list_kompen']);
    Route::post('/list', [HistoryKompenSelesaiController::class, 'list']);
    Route::get('/{id}/show_ajax', [HistoryKompenSelesaiController::class, 'show_ajax']);
});

Route::group(['prefix' => 'kompetensi_mahasiswa'], function(){
    Route::get('/', [KompetensiMahasiswaController::class, 'index']);
    Route::post('/list', [KompetensiMahasiswaController::class, 'list']);
    Route::get('/create_ajax', [KompetensiMahasiswaController::class, 'create_ajax']);
    Route::post('/ajax', [KompetensiMahasiswaController::class, 'store_ajax']);
    Route::get('/{id}/delete_ajax', [KompetensiMahasiswaController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [KompetensiMahasiswaController::class, 'delete_ajax']);
});

Route::group(['middleware'=>'authorize:ADM,DSN,TDK'], function(){
    Route::get('/profile-pa', [ProfilePersonilController::class, 'index']);
    Route::post('/profile-pa/update_profile/{id}', [ProfilePersonilController::class, 'update_profile']);
    Route::post('/profile-pa/update_password/{id}', [ProfilePersonilController::class, 'update_password']);
    Route::post('/profile-pa/update_picture/{id}', [ProfilePersonilController::class, 'update_picture']);
});
Route::group(['middleware'=>'authorize:MHS'], function(){
    Route::get('/profile-mhs', [ProfileMahasiswaController::class, 'index']);
    Route::post('/profile-mhs/update_profile/{id}', [ProfileMahasiswaController::class, 'update_profile']);
    Route::post('/profile-mhs/update_password/{id}', [ProfileMahasiswaController::class, 'update_password']);
    Route::post('/profile-mhs/update_picture/{id}', [ProfileMahasiswaController::class, 'update_picture']);
});
});