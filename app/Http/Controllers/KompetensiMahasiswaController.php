<?php

namespace App\Http\Controllers;

use App\Models\KompetensiMahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KompetensiMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kompetensi',
            'list' => ['Home', 'Kopetensi']
        ];
        $page = (object) [
            'title' => 'Daftar Kopetensi yang Terdaftar dalam Sistem'
        ];

        $activeMenu = 'Kompetensi_mahasiswa';
        $Kompetensi_mahasiswa = KompetensiMahasiswaModel::all();
        return view('mahasiswa.kompetensi_mahasiswa.index', compact('breadcrumb', 'page', 'Kompetensi_mahasiswa', 'activeMenu'));
    }

    public function list(Request $request)
    {
        // Ambil data kompetensi mahasiswa dengan relasi 'kompetensi' dan 'mahasiswa'
        $kompetensi_mahasiswa = KompetensiMahasiswaModel::with([
            'kompetensi' => function ($query) {
                $query->select('id_kompetensi', 'nama_kompetensi', 'deskripsi_kompetensi');
            },
            'mahasiswa' => function ($query) {
                $query->select('id_mahasiswa', 'nama');
            }
        ])->select('id_kompetensi_mahasiswa', 'id_mahasiswa', 'id_kompetensi');
    
        // Return data menggunakan DataTables
        return DataTables::of($kompetensi_mahasiswa)
            ->addIndexColumn()
            ->addColumn('nama_mahasiswa', function ($item) {
                return $item->mahasiswa->nama;
            })
            ->addColumn('nama_kompetensi', function ($item) {
                return $item->kompetensi->nama_kompetensi;
            })
            ->addColumn('deskripsi_kompetensi', function ($item) {
                return $item->kompetensi->deskripsi_kompetensi;
            })
            ->addColumn('aksi', function ($item) {
                $editUrl = e(url('/kompetensi_mahasiswa/' . $item->id_kompetensi_mahasiswa . '/edit_ajax'));
                $deleteUrl = e(url('/kompetensi_mahasiswa/' . $item->id_kompetensi_mahasiswa . '/delete_ajax'));
    
                $btn = '<button onclick="modalAction(\'' . $editUrl . '\')" 
                            class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . $deleteUrl . '\')" 
                            class="btn btn-danger btn-sm">Hapus</button>';
    
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu DataTables untuk tidak escape HTML di kolom 'aksi'
            ->make(true);
    }
}
