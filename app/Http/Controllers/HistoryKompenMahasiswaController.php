<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use App\Models\KompenDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HistoryKompenMahasiswaController extends Controller
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
        return view('mahasiswa.histori_mahasiswa.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompens' => $kompens,
            'activeMenu' => $activeMenu,
            'jeniskompen' => $jeniskompen
        ]);
    }

    public function list_kompen(Request $request)
    {
        $id = auth()->user()->id_mahasiswa;
        $kompens = KompenModel::with(['personil:id_personil,nama,username', 'jeniskompen:id_jenis_kompen,nama_jenis', 'detailkompen:id_kompen_detail,progres_1,progres_2,status'])
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
                'tanggal_selesai',
                'status'
            )->whereHas('detailkompen', function ($query) use ($id) {
                $query->where('id_mahasiswa', $id);
            })
            ->where("is_selesai",0);
    
        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }
    
        return DataTables::of($kompens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kompen) {
                $today = now()->toDateString();
    
                // Cek jika kompen sudah selesai
                if ($kompen->is_selesai == 1) {
                    return '<span class="badge bg-success">Kompen Telah Selesai</span>';
                }
    
                // Cek apakah tanggal selesai sudah terlewat
                if ($today > $kompen->tanggal_selesai) {
                    return '<span class="badge bg-danger">Waktu Sudah Habis</span>';
                }
    
                // Jika masih dalam rentang waktu, tampilkan tombol upload progress
                $btn = '<button onclick="modalAction(\'' . url('/histori_mahasiswa/' . $kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Upload Progress</button> ';
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
            'progres_2'
        )
            ->with('kompen', 'mahasiswa.prodi')
            ->with(['mahasiswa:id_mahasiswa,nama,nama_prodi,jam_kompen'])->get();

        return DataTables::of($DetailKompen)
            ->addIndexColumn()
            ->addColumn('aksi', function ($DetailKompen) {
                $btn = '<button onclick="modalAction(\'' . url('/kompen/' . $DetailKompen->id_detail_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Proses Verif</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax($id)
    {
        $detailKompen = KompenDetailModel::select('id_kompen_detail', 'id_kompen', 'id_mahasiswa', 'progres_1', 'progres_2')
            ->where('id_kompen', $id)
            ->whereHas('mahasiswa', function ($query) {
                $query->where('id_mahasiswa', auth()->user()->id_mahasiswa);
            })
            ->with('mahasiswa', 'kompen')
            ->first();

        $kompen = KompenModel::find($id);

        return view('mahasiswa.histori_mahasiswa.show_ajax', compact('detailKompen', 'kompen'));
    }

    // public function show_tugas_ajax(string $id)
    // {
    //     $detailKompen = KompenDetailModel::select('id_kompen_detail', 'id_kompen', 'id_mahasiswa', 'progres_1', 'progres_2')
    //         ->where('id_kompen', $id)
    //         ->whereHas('mahasiswa', function ($query) {
    //             $query->where('id_mahasiswa', auth()->user()->id_mahasiswa);
    //         })
    //         ->with('mahasiswa', 'kompen')
    //         ->first();

    //     $kompen = KompenModel::find($id);

    //     return view('mahasiswa.histori_mahasiswa.show_tugas_ajax', compact('detailKompen', 'kompen'));
    // }

    // public function detail_tugas_ajax(Request $request, $id)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $detailKompen = KompenDetailModel::find($id)
    //         ->where('id_kompen',$id)
    //         ->whereHas('mahasiswa', function($query){
    //             $query->where('id_mahasiswa', auth()->user()->id_mahasiswa);
    //         })
    //         ->with('mahasiswa','kompen')
    //         ->first();

    //         if ($detailKompen) {
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data berhasil ditampilkan'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Data tidak ditemukan'
    //             ]);
    //         }
    //     }
    //     return redirect('/histori_mahasiswa');
    // }

    public function updateProgres(Request $request, $id)
    {
        // Validasi input dengan aturan tambahan
        $request->validate([
            'progres_1' => 'required|string|max:255',
            'progres_2' => 'required|string|max:255',
        ], [
            'progres_1.required' => 'Progres 1 harus diisi terlebih dahulu.',
            'progres_2.required' => 'Progres 2 harus diisi setelah Progres 1.'
        ]);
    
        try {
            // Cari data kompen berdasarkan ID
            $detailKompen = KompenDetailModel::findOrFail($id);
            $kompen = $detailKompen->kompen;
    
            // Periksa apakah tanggal sekarang masih dalam rentang kompen
            $today = now()->toDateString();
            $tanggalSelesai = $kompen->tanggal_selesai;
    
            // Jika sudah melewati tanggal selesai, kembalikan pesan error
            if ($today > $tanggalSelesai) {
                return response()->json([
                    'status' => false,
                    'message' => 'Hayolo kamu sudah lewat tenggat uploud kompen!!!',
                ], 400);
            }
    
            // Cek apakah progres_1 sudah ada sebelum mengizinkan update progres_2
            if ($detailKompen->progres_1 === null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Progres 1 harus diisi terlebih dahulu sebelum mengisi Progres 2.',
                ], 400);
            }
    
            // Update data progres
            $detailKompen->update([
                'progres_1' => $request->input('progres_1'),
                'progres_2' => $request->input('progres_2'),
            ]);
    
            // Respons sukses
            return response()->json([
                'status' => true,
                'message' => 'Progres berhasil diperbarui',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika data tidak ditemukan
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan lain
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memperbarui progres',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
