<?php

namespace App\Http\Controllers;

use App\Models\ProdiModel;
use App\Models\LevelModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar Mahasiswa',
            'list' => ['Home', 'Mahasiswa']
        ];

        $page = (object)[
            'title' => 'Daftar Mahasiswa Jurusan Teknoloogi Informasi'
        ];

        $activeMenu = 'mahasiswa';
        $prodi = ProdiModel::all();
        $level = LevelModel::all();
        return view('mahasiswa.index', ['breadcrumb' => $breadcrumb,
            'page' => $page,
            'prodi' => $prodi,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $mahasiswas = MahasiswaModel::select('nomor_induk', 'username', 'nama', 'semester', 'password', 'jam_alpha','jam_kompen','jam_kompen_selesai','id_prodi','id_level')->with('prodi', 'level');

        // if ($request->supplier_id) {
        //     $stoks->where('supplier_id', $request->supplier_id);
        // } else if ($request->barang_id) {
        //     $stoks->where('barang_id', $request->barang_id);
        // } else if ($request->user_id) {
        //     $stoks->where('user_id', $request->user_id);
        // }

        return DataTables::of($mahasiswas)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($mahasiswa) {
                $btn = '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;    
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create_ajax(){
        $prodi = ProdiModel::select('id_prodi', 'nama_prodi')->get();
        $prodi = LevelModel::select('id_level', 'nama_level')->get();

        return view('tambah_mahasiswa.create_ajax')
                    -> with('prodi', $prodi)
                    -> with('level', $level);
    }

    public function store_ajax(Request $request){
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'nomor_induk' => 'required',
                'username' => 'required',
                'nama' => 'required',
                'semester' => 'required',
                'password' => 'required',
                'id_prodi' => 'required',
                'id_level' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
            ]);
        }

        MahasiswaModel::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data Mahasiswa berhasil disimpan'
        ]);
    }
    redirect('/');
    }


}