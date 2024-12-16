<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use App\Models\KompenDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HistoryKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Histori Kompen',
            'list' => ['Home', 'Histori Kompen']
        ];

        $page = (object) [
            'title' => 'Daftar Histori Kompen Jurusan Teknologi Informasi'
        ];

        $activeMenu = 'kompen';
        $jeniskompen = JenisKompenModel::all();
        $kompens = KompenModel::all();
        return view('admin.histori_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompens' => $kompens,
            'activeMenu' => $activeMenu,
            'jeniskompen' => $jeniskompen
        ]);
    }

    public function list_kompen(Request $request)
    {
        $kompens = KompenModel::with(['personil:id_personil,nama,username', 'jeniskompen:id_jenis_kompen,nama_jenis'])
            ->select(
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
            )->where('status', 'setuju')
            ->where('is_selesai',0);
    
        if (auth()->user()->level->kode_level !== 'ADM') {
            $kompens->where('id_personil', auth()->user()->id_personil);
        }
    
        $kompens = $kompens->get();
    
        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }
    
        return DataTables::of($kompens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kompen) {
                $buttonText = $kompen->is_selesai == 1 ? 'Done' : 'Lihat';
                $btn = '<button onclick="modalAction(\'' . url('/histori_kompen/' . $kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">' . $buttonText . '</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function list(Request $request)
    {
        $DetailKompen = KompenDetailModel::select(
            'id_kompen_detail',
            'id_kompen',
            'id_mahasiswa',
            'progres_1',
            'progres_2',
            'status'
        )
            ->with('kompen', 'mahasiswa.prodi')
            ->with(['mahasiswa:id_mahasiswa,nama,nama_prodi,jam_kompen'])->get();
    }

    public function show_ajax($id)
    {
        $detailkompen = KompenDetailModel::select('id_kompen_detail', 'id_kompen', 'id_mahasiswa', 'progres_1', 'progres_2', 'status')
            ->where('id_kompen', $id)
            ->with('mahasiswa', 'kompen')
            ->get();
        $kompen = KompenModel::find($id);

        return view('admin.histori_kompen.show_ajax', ['detailkompen' => $detailkompen, 'kompen' => $kompen]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,acc,reject',
        ]);

        $kompendetail = KompenDetailModel::findOrFail($request->id_kompen_detail);

        if ($kompendetail->status == 'acc' || $kompendetail->status == 'reject') {
            return redirect('/histori_kompen')->with('error', 'Status tidak dapat diubah lagi.');
        }
        // Check if status is being changed
        if ($kompendetail->status != $request->status) {
            // Update status
            $kompendetail->status = $request->status;

            // Create new record in 'detail_kompen' table if status is changed to 'acc'
            if ($request->status == 'acc') {
                KompenModel::create([
                    'is_selesai' => 1, // Menggunakan 1 untuk tinyint(1)
                ]);
            } elseif ($request->status == 'reject') {
                KompenModel::create([
                    'is_selesai' => 0, // Menggunakan 0 untuk tinyint(1)
                ]);
            }

            $kompendetail->save();

            return redirect('/histori_kompen')->with('success', 'Status updated.');
        } else {
            return redirect('/histori_kompen')->with('error', 'Status has not been changed.');
        }
    }

    public function updateKompenSelesai(Request $request)
    {
        try {
            $idKompen = $request->input('id_kompen');
    
            // Validasi input
            if (!$idKompen) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'ID Kompen tidak valid'
                ], 400);
            }
    
            // Cek apakah ada detail kompen dengan status pending
            $pendingDetails = KompenDetailModel::where('id_kompen', $idKompen)
                ->where('status', 'pending')
                ->count();
    
            // Jika masih ada detail kompen yang pending, kembalikan error
            if ($pendingDetails > 0) {
                return response()->json([
                    'status' => 'pending_exists',
                    'message' => 'Tidak dapat menyelesaikan kompen. Masih terdapat pengajuan dengan status pending.',
                    'pending_count' => $pendingDetails
                ], 422);
            }
    
            // Cari dan update data
            $kompen = KompenModel::findOrFail($idKompen);
            $kompen->is_selesai = 1;
            $kompen->save();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Kompen berhasil diselesaikan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyelesaikan kompen: ' . $e->getMessage()
            ], 500);
        }
    }
}
