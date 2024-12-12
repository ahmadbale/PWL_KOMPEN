<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardDosenController extends Controller
{
    public function index()
    {
        // Mendapatkan ID dosen yang sedang login
        $userId = Auth::id();
        
        // Query untuk mendapatkan data tugas kompensasi dosen
        $kompenData = DB::table('kompen')
            ->where('id_personil', $userId)
            ->select('nomor_kompen', 'nama', 'deskripsi', 'jam_kompen', 'status', 'is_selesai', 'tanggal_mulai', 'tanggal_selesai')
            ->get();
        
        // Mengelompokkan data berdasarkan status
        $statusData = DB::table('kompen')
            ->where('id_personil', $userId)
            ->select('status', DB::raw('COUNT(*) as total'), DB::raw('SUM(jam_kompen) as total_jam'))
            ->groupBy('status')
            ->get();
        
        return view('dahsboard', [
            'kompenData' => $kompenData,
            'statusData' => $statusData,
            'activeMenu' => 'dahsboard'
        ]);
    }
}