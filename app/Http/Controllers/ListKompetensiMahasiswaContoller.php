<?php

namespace App\Http\Controllers;
use App\Models\KompetensiModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ListKompetensiMahasiswaContoller extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kompetensi Mahasiswa',
            'list' => ['Home', 'Kopetensi Mahasiswa']
        ];
        $page = (object) [
            'title' => 'Daftar Kopetensi yang Terdaftar dalam Sistem'
        ];

        $activeMenu = 'listkompenmahasiswa';
        $kompetensi = KompetensiModel::all();
        return view('admin.kompetensi.index', compact('breadcrumb', 'page', 'listkompenmahasiswa', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $kompetensi = KompetensiModel::select('id_kompetensi', 'nama_kompetensi', 'deskripsi_kompetensi');

        if ($request->has('id_kompetensi')) {
            $kompetensi->where('id_kompetensi', $request->id_kompetensi);
        }

        return DataTables::of($kompetensi)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kompetensi) {
            $btn = '<button onclick="modalAction(\'' . url('/kompetensi/' . $kompetensi->id_kompetensi 
            . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            
            $btn .= '<button onclick="modalAction(\'' . url('/kompetensi/' . $kompetensi->id_kompetensi 
            . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    
    }

}
