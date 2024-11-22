<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuatKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompen',
            'list' => ['Home', 'Kompen']
        ];

        $page = (object) [
            'title' => 'Daftar Kompen Jurusan Teknologi Informasi'
        ];

        $activeMenu = 'kompen';
        $kompens = KompenModel::all();
        return view('admin.buat_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompens' => $kompens,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $kompens = KompenModel::select(
            'id_kompen',
            'nomor_kompen',
            'nama',
            'deskripsi',
            'id_personil',
            'id_jenis_kompen',
            'kuota',
            'jam_kompen',
            'status',
            'is_selesai',
            'tanggal_mulai',
            'tanggal_selesai'
        )->with('personil', 'jeniskompen');

        return DataTables::of($kompens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kompen) {
                $btn = '<button onclick="modalAction(\'' . url('/kompen/' . $kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kompen/' . $kompen->id_kompen . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kompen/' . $kompen->id_kompen . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        // Data tambahan (jika diperlukan)
        $jenis = JenisKompenModel::select('id_jenis_kompen', 'nama_jenis')->get();
        return view('admin.buat_kompen.create_ajax', [
            'jenis' => $jenis
        ]);
    }

    public function store_ajax(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|min:3|max:50',
            'deskripsi' => 'required|min:5|max:255',
            'kuota' => 'required|numeric|min:1',
            'jam_kompen' => 'required|numeric|min:1',
            'status' => 'required|boolean',
            'id_jenis_kompen' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',

        ]);
    
        // Generate Nomor Kompen (kode unik)
        $nomorKompen = 'KP-' . strtoupper(Str::random(6)) . '-' . time();
    
        // Simpan ke database
        $kompen = new KompenModel();
        $kompen->nomor_kompen = $nomorKompen;
        $kompen->nama = $request->nama;
        $kompen->deskripsi = $request->deskripsi;
        $kompen->kuota = $request->kuota;
        $kompen->jam_kompen = $request->jam_kompen;
        $kompen->status = $request->status;
        $kompen->id_jenis_kompen = $request->id_jenis_kompen;
        $kompen->id_personil = $request->id_personil;
        $kompen->tanggal_mulai = $request->tanggal_mulai;
        $kompen->tanggal_selesai = $request->tanggal_selesai;
        $kompen->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Data Kompen berhasil ditambahkan',
            'data' => $kompen,
        ]);
    }

    // public function edit_ajax(string $id)
    // {
    //     $kompen = KompenModel::find($id);
    //     $jenis_kompen = JenisKompenModel::select('id_jenis_kompen', 'nama')->get();

    //     if ($kompen) {
    //         return view('admin.kompen.edit_ajax', [
    //             'kompen' => $kompen,
    //             'jenis_kompen' => $jenis_kompen
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => false,
    //         'message' => 'Data tidak ditemukan'
    //     ]);
    // }

    // public function update_ajax(Request $request, string $id)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'nomor_kompen' => 'required|max:36|unique:kompen,nomor_kompen,' . $id . ',id_kompen',
    //             'nama' => 'required|max:40',
    //             'deskripsi' => 'nullable|max:255',
    //             'id_personil' => 'required|exists:personil,id_personil',
    //             'id_jenis_kompen' => 'required|exists:jenis_kompen,id_jenis_kompen',
    //             'kuota' => 'required|integer|min:1',
    //             'jam_kompen' => 'required|integer|min:1',
    //             'status' => 'required|boolean',
    //             'is_selesai' => 'required|boolean',
    //             'tanggal_mulai' => 'required|date',
    //             'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi gagal.',
    //                 'msgField' => $validator->errors(),
    //             ]);
    //         }

    //         $kompen = KompenModel::find($id);
    //         if ($kompen) {
    //             $kompen->update($request->all());
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data berhasil diupdate'
    //             ]);
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Data tidak ditemukan'
    //         ]);
    //     }

    //     return redirect('/kompen');
    // }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kompen = KompenModel::find($id);
            if ($kompen) {
                $kompen->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return redirect('/');
    }
}
