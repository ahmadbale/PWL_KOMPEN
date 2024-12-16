<?php

namespace App\Http\Controllers;

use App\Models\KompetensiMahasiswaModel;
use App\Models\KompetensiModel;
use App\Models\MahasiswaModel;
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
        ])
        ->select('id_kompetensi_mahasiswa', 'id_mahasiswa', 'id_kompetensi')
        ->where('id_mahasiswa', auth()->user()->id_mahasiswa);
    
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
                $deleteUrl = e(url('/kompetensi_mahasiswa/' . $item->id_kompetensi_mahasiswa . '/delete_ajax'));
    
                $btn = '<button onclick="modalAction(\'' . $deleteUrl . '\')" 
                            class="btn btn-danger btn-sm">Hapus</button>';
    
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu DataTables untuk tidak escape HTML di kolom 'aksi'
            ->make(true);
    }

        // Ajax
        public function create_ajax()
        {
            // Ambil data mahasiswa dan kompetensi untuk dropdown
            $mahasiswas = MahasiswaModel::select('id_mahasiswa', 'nama')->get();
            $kompetensis = KompetensiModel::select('id_kompetensi', 'nama_kompetensi')->get();
        
            return view('mahasiswa.kompetensi_mahasiswa.create_ajax', compact('mahasiswas', 'kompetensis'));
        }
        
        public function store_ajax(Request $request)
        {
            if ($request->ajax() || $request->wantsJson()) {
                $rules = [
                    'id_kompetensi' => 'required|exists:kompetensi,id_kompetensi'
                ];
        
                $validator = Validator::make($request->all(), $rules);
        
                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Validasi Gagal',
                        'errors' => $validator->errors(),
                    ]);
                }
        
                // Cek apakah kombinasi mahasiswa dan kompetensi sudah ada
                $existingRecord = KompetensiMahasiswaModel::where([
                    'id_mahasiswa' => $request->id_mahasiswa,
                    'id_kompetensi' => $request->id_kompetensi
                ])->first();
        
                if ($existingRecord) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Kombinasi mahasiswa dan kompetensi sudah ada.'
                    ]);
                }
        
                $kompetensiMahasiswa = KompetensiMahasiswaModel::create($request->all());
        
                return response()->json([
                    'status' => true,
                    'message' => 'Data Kompetensi Mahasiswa berhasil disimpan.',
                    'data' => $kompetensiMahasiswa
                ]);
            }
        
            return redirect('/');
        }

        public function confirm_ajax(string $id)
        {
            $kompetensi_mahasiswa = KompetensiMahasiswaModel::find($id);
    
            return view('mahasiswa.kompetensi_mahasiswa.confirm_ajax', ['kompetensi_mahasiswa' => $kompetensi_mahasiswa]);
        }
    
        public function delete_ajax(Request $request, $id)
        {
            if ($request->ajax() || $request->wantsJson()) {
                $kompetensi_mahasiswa = KompetensiMahasiswaModel::find($id);
                if ($kompetensi_mahasiswa) {
                    $kompetensi_mahasiswa->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'data tidak ditemukan'
                    ]);
                }
            }
            return redirect('/');
        }
}
