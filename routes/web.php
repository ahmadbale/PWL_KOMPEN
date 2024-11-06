<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\PengaturanController;
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


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/tugas', [TugasController::class, 'index']);
Route::get('/history', [HistoryController::class, 'index']);
Route::get('/progres', [ProgresController::class, 'index']);
Route::get('/notifikasi', [NotifikasiController::class, 'index']);
Route::get('/pengaturan', [PengaturanController::class, 'index']);
Route::get('/verifikasitugas', [VerifikasiTugasController::class, 'index']);
Route::get('/verifikasi', [VerifikasiController::class, 'index']);
Route::get('/tambahdosen', [DosenController::class, 'index']);
Route::get('/tambahmahasiswa', [MahasiswaController::class, 'index']);
Route::get('/tambahtendik', [TendikController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
