<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CariKompenController;

// Route untuk login mahasiswa
Route::post('/mahasiswa/login', [LoginController::class, 'mahasiswaLogin']);

// Route untuk login personil akademik
Route::post('/personil/login', [LoginController::class, 'personilLogin']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('kompen')->group(function () {
    Route::get('/', [CariKompenController::class, 'index']);               // Menampilkan daftar kompen
    Route::get('/list', [CariKompenController::class, 'list']);            // Data kompen dengan DataTables
    Route::get('/{id}/detail', [CariKompenController::class, 'detail_ajax']); // Detail kompen (JSON)
    Route::get('/{id}/show_ajax', [CariKompenController::class, 'show_ajax']); // Menampilkan detail kompen (HTML)
    Route::post('/pengajuan', [CariKompenController::class, 'store_pengajuan']); // Simpan pengajuan kompen
});


// Route::get('cari_kompen/',[CariKompenController::class, 'index']);
// Route::post('cari_kompen/list',[CariKompenController::class, 'list']);