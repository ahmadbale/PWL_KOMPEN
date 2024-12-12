<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use App\Models\PengajuanKompenModel;
use App\Models\PersonilAkademikModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CariKompenController extends Controller
{
    // Menampilkan daftar kompen (JSON)
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Daftar Kompen',
            'data' => KompenModel::with(['personil', 'jeniskompen'])->get()
        ]);
    }

    // Menampilkan daftar kompen dengan DataTables
    public function list(Request $request)
    {
        $kompens = KompenModel::with(['personil:id_personil,nama,username', 'jeniskompen:id_jenis_kompen,nama_jenis'])
            ->select(
                'id_kompen', 'id_personil', 'nama', 
                'id_jenis_kompen', 'kuota', 'tanggal_mulai', 
                'tanggal_selesai', 'jam_kompen', 'status'
            )->where('status', 'setuju');

        // Filter berdasar request
        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }

        if ($request->id_personil) {
            $kompens->where('id_personil', $request->id_personil);
        }

        return DataTables::of($kompens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($cari_kompen) {
                return '<button onclick="modalAction(\'' . url('/api/kompen/' . $cari_kompen->id_kompen . '/detail') . '\')" class="btn btn-info btn-sm">Detail</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan detail kompen (JSON)
    public function detail_ajax(Request $request, $id)
    {
        $kompen = KompenModel::with(['personil', 'jeniskompen'])->find($id);

        if (!$kompen) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $kompen
        ]);
    }

    // Menampilkan detail kompen untuk modal view
    public function show_ajax(string $id)
    {
        $kompen = KompenModel::find($id);

        if (!$kompen) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return view('mahasiswa.cari_kompen.show_ajax', ['kompen' => $kompen]);
    }

    // Menyimpan pengajuan kompen
    public function store_pengajuan(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'id_kompen' => 'required|exists:kompen,id_kompen'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek apakah pengajuan sudah ada
        $existingPengajuan = PengajuanKompenModel::where('id_kompen', $request->id_kompen)
            ->where('id_mahasiswa', auth()->user()->id_mahasiswa)
            ->where('status', 'pending')
            ->first();

        if ($existingPengajuan) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah pernah mengajukan kompen ini sebelumnya.'
            ]);
        }

        // Simpan pengajuan
        PengajuanKompenModel::create([
            'id_kompen' => $request->id_kompen,
            'id_mahasiswa' => auth()->user()->id_mahasiswa,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pengajuan kompen berhasil disimpan.'
        ], 200);
    }
}
