<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mendapatkan data kompensasi hanya untuk mahasiswa yang login
        $kompensasiData = DB::table('mahasiswa')
            ->where('id_mahasiswa', $userId)
            ->select('nama', 'jam_alpha', 'jam_kompen')
            ->get();

        // Menghitung total alpha dan kompensasi
        $totalAlpha = $kompensasiData->sum('jam_alpha');
        $totalKompensasi = $kompensasiData->sum('jam_kompen');

        return view('welcome', [
            'kompensasiData' => $kompensasiData,
            'totalAlpha' => $totalAlpha,
            'totalKompensasi' => $totalKompensasi,
            'activeMenu' => 'dashboard'
        ]);
    }
}