<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CariKompenController;

// Route untuk login mahasiswa
Route::post('/mahasiswa/login', [LoginController::class, 'mahasiswaLogin']);

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

Route::post('cari_kompen/list',[CariKompenController::class, 'list']);