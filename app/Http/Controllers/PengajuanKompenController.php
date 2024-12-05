<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKompenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PengajuanKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pengajuan Kompen',
            'list' => ['Home', 'Pengajuan']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan Kompen Jurusan Teknologi Informasi'
        ];

        $activeMenu = 'pengajuan_kompen';
        $pengajuan_kompen = PengajuanKompenModel::all();
        return view('admin.pengajuan_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'pengajuan_kompen' => $pengajuan_kompen,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $pengajuankompen = PengajuanKompenModel::select(
            'id_pengajuan_kompen',
            'id_kompen',
            'id_mahasiswa',
            'status',
        )->with('kompen', 'mahasiswa')->get();
        
        if ($request->id_pengajuan_kompen){
            $pengajuankompen->where('id_pengajuan_kompen', $request->id_pengajuan_kompen);
        }

        return DataTables::of($pengajuankompen)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengajuankompen) {
                $btn = '<button onclick="modalAction(\'' . url('/pengajuankompen/' . $pengajuankompen->id_pengajuan_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Pengajuan Kompen</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function show_ajax(string $id)
    {
        $pengajuankompen = PengajuanKompenModel::find($id);

        return view('admin.pengajuan_kompen.show_ajax', ['pengajuankompen' => $pengajuankompen]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,acc,reject', // Validasi status hanya menerima nilai tertentu
        ]);
    
        // Temukan data berdasarkan ID Pengajuan Kompen
        $pengajuankompen = PengajuanKompenModel::findOrFail($request->id_pengajuan_kompen);
    
        // Update status
        $pengajuankompen->status = $request->status;
        $pengajuankompen->save();
    
        // Redirect kembali ke halaman pengajuan kompen dengan pesan sukses
        return redirect('/pengajuankompen')->with('success', 'Status berhasil diperbarui.');
    }
    
    
}
