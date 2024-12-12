<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use Yajra\DataTables\Facades\DataTables;

class TolakKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompen Ditolak',
            'list' => ['Home', 'Kompen  Ditolak']
        ];

        $page = (object) [
            'title' => 'Daftar Kompen Ditolak Jurusan Teknologi Informasi'
        ];

       
        $activeMenu = 'tolak_kompen';
        $jeniskompen = JenisKompenModel::all();
        $kompen = KompenModel::all();
        return view('admin.tolak_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompen' => $kompen,
            'activeMenu' => $activeMenu,
            'jeniskompen' => $jeniskompen
        ]);
    }

    public function list(Request $request )
    {
        $kompens = KompenModel::with(['personil:id_personil,nama,username', 'jeniskompen:id_jenis_kompen,nama_jenis'])
        ->select(
            'kompen.id_kompen',
            'kompen.id_personil',
            'kompen.nama',
            'kompen.id_jenis_kompen',
            'kompen.kuota',
            'kompen.tanggal_mulai',
            'kompen.tanggal_selesai',
            'kompen.jam_kompen',
            'kompen.status'
        )->where('status', 'ditolak');

        if (auth()->user()->level->kode_level !== 'ADM') {
            $kompens->where('id_personil', auth()->user()->id_personil);
        }   
        $kompens = $kompens->get();
        
        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }
    

        return DataTables::of($kompens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($tolak_kompen) {
                $btn = '<button onclick="modalAction(\'' . url('/tolak_kompen/' . $tolak_kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function detail_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kompen = KompenModel::find($id);
            if ($kompen) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil ditampilkan'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/tolak_kompen');
    }

    public function show_ajax(string $id)
    {
        $kompen = KompenModel::find($id);

        return view('admin.tolak_kompen.show_ajax', ['kompen' => $kompen]);
    }

    public function ajukan(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'id_kompen' => 'required|exists:kompen,id_kompen', // id_kompen harus ada di tabel kompen
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa', // id_mahasiswa harus ada di tabel mahasiswa
        ]);

        // Cek jika mahasiswa sudah pernah mengajukan tugas kompen untuk id_kompen yang sama
        $existingPengajuan = KompenModel::where('id_kompen', $request->auth()->user()->id_mahasiswa)
            ->where('id_mahasiswa', $request->auth()->user()->id_mahasiswa)
            ->first();

        if ($existingPengajuan) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah mengajukan tugas kompen untuk item ini!',
            ], 400);
        }

        // Buat data pengajuan baru
        $pengajuan = new KompenModel();
        $pengajuan->id_kompen = $request->id_kompen;
        $pengajuan->id_mahasiswa = $request->auth()->user()->id_mahasiswa;
        $pengajuan->status = 'pending'; // Status default adalah pending
        $pengajuan->save();

        return response()->json([
            'status' => true,
            'message' => 'Pengajuan tugas kompen berhasil!',
            'data' => $pengajuan,
        ]);
    }
}
