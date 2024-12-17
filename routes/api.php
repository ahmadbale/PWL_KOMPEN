<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CariKompenController;
use App\Http\Controllers\Api\HistoryKompenMahasiswaController;

// Route untuk login mahasiswa
Route::post('/mahasiswa/login', [LoginController::class, 'mahasiswaLogin']);

// Route untuk login personil akademik
Route::post('/personil/login', [LoginController::class, 'personilLogin']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('kompen')->group(function () {
    Route::get('/', [CariKompenController::class, 'index']);               // Menampilkan daftar kompen
    Route::get('/list', [CariKompenController::class, 'list']);            // Data kompen dengan DataTables
    Route::get('/{id}/detail', [CariKompenController::class, 'detail_ajax']); // Detail kompen (JSON)
    Route::get('/{id}/show_ajax', [CariKompenController::class, 'show_ajax']); // Menampilkan detail kompen (HTML)
    Route::post('/pengajuan', [CariKompenController::class, 'store_pengajuan']); // Simpan pengajuan kompen
});

// Prefix 'histori_mahasiswa' untuk API Histori Kompen Mahasiswa
Route::prefix('histori_mahasiswa')->group(function () {
    // Endpoint untuk mendapatkan breadcrumb dan daftar jenis kompen
    Route::get('/', [HistoryKompenMahasiswaController::class, 'index']);

    // Endpoint untuk mendapatkan histori kompen mahasiswa
    Route::get('/list_kompen', [HistoryKompenMahasiswaController::class, 'listKompen']);

    // Endpoint untuk mendapatkan list detail kompen
    Route::get('/list', [HistoryKompenMahasiswaController::class, 'list']);

    // Endpoint untuk menampilkan detail histori kompen berdasarkan ID
    Route::get('/{id}/show', [HistoryKompenMahasiswaController::class, 'show']);

    // Endpoint untuk memperbarui progres mahasiswa berdasarkan ID
    Route::put('/{id}/update_progres', [HistoryKompenMahasiswaController::class, 'updateProgres']);
});




// Route::get('cari_kompen/',[CariKompenController::class, 'index']);
// Route::post('cari_kompen/list',[CariKompenController::class, 'list']);