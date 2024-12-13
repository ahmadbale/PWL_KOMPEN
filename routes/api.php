<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CariKompenController;

// Route untuk login mahasiswa
Route::post('/mahasiswa/login', [LoginController::class, 'mahasiswaLogin']);

// Route untuk login personil akademik
Route::post('/personil/login', [LoginController::class, 'personilLogin']);

// Route untuk login personil akademik
Route::post('/personil/login', [LoginController::class, 'personilLogin']);

// Route untuk user profile mahasiswa
// Route::middleware('auth:api_mahasiswa')->get('/mahasiswa', function (Request $request) {
//     return response()->json([
//         'success' => true,
//         'user' => auth('api_mahasiswa')->user(),
//     ]);
// });

// // Route untuk user profile personil akademik
// Route::middleware('auth:api_personil')->get('/personil', function (Request $request) {
//     return response()->json([
//         'success' => true,
//         'user' => auth('api_personil')->user(),
//     ]);
// });
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
