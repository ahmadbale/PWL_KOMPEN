<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use App\Models\KompenDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HistoryKompenMahasiswaSelesaiController extends Controller
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

        $activeMenu = 'histori_mahasiswa_selesai';
        $jeniskompen = JenisKompenModel::all();
        $kompens = KompenModel::all();
        return view('mahasiswa.histori_mahasiswa_selesai.index', [
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
        $kompens = KompenModel::with(['personil:id_personil,nama,username', 'jeniskompen:id_jenis_kompen,nama_jenis', 'detailkompen:id_kompen_detail,progres_1,progres_2'])
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
            )->whereHas('detailkompen', function ($query) use ($id) {
                $query->where('id_mahasiswa', $id);
            })
            ->where('is_selesai',1);
    
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
            return '<button onclick="modalAction(\'' . url('/histori_mahasiswa_selesai/' . $kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Upload Progress</button>';
        })
        ->addColumn('cetak', function ($kompen) {
            $today = now()->toDateString();
        
            // Cek jika kompen sudah selesai
            if ($kompen->is_selesai == 1 || $today > $kompen->tanggal_selesai) {
                return '<a href="' . url('/histori_mahasiswa_selesai/' . $kompen->id_kompen . '/export_pdf') . '" class="btn btn-info btn-sm">Cetak</a>';
            }
        
            return ''; // Tidak menampilkan tombol cetak jika belum memenuhi kondisi
        })
        ->rawColumns(['aksi', 'cetak'])
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

        return view('mahasiswa.histori_mahasiswa_selesai.show_ajax', compact('detailKompen', 'kompen'));
    }
    public function updateProgres(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'progres_1' => 'required|string|max:255',
            'progres_2' => 'required|string|max:255',
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

    public function export_pdf()
    {
        $kompen = KompenDetailModel::select('id_kompen', 'id_mahasiswa')
            ->where('id_mahasiswa', auth()->user()->id_mahasiswa)
            ->with('kompen', 'mahasiswa','kompen.personil')
            ->first();
        
        // Generate QR Code with a URL (I used the kompen number as an example)
        $qrCode = QrCode::size(100)
            ->generate('
            Nomor Kompen : '.$kompen->kompen->nomor_kompen. '
            Status Kompen : '.$kompen->kompen->is_selesai .'
            Mahasiswa : '.$kompen->mahasiswa->nama .'
            Pemberi Tugas : '.$kompen->kompen->personil->nama.'
            Tugas : '.$kompen->kompen->nama.'
            Deskripsi Kompen : '.$kompen->kompen->deskripsi.'
            ');
        
        // Load PDF view and pass both kompen and qrCode
        $pdf = Pdf::loadView('mahasiswa.histori_mahasiswa_selesai.export_pdf', [
            'kompen' => $kompen,
            'qrCode' => base64_encode($qrCode)
        ]);
        
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();
    
        return $pdf->stream('Kompensasi_'.date('Y-m-d H:i:s').'.pdf');
    }
}
