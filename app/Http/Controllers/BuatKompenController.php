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
        $jeniskompen = JenisKompenModel::all();
        $kompens = KompenModel::all();
        return view('admin.buat_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompens' => $kompens,
            'activeMenu' => $activeMenu,
            'jeniskompen' => $jeniskompen
        ]);
    }

    public function list(Request $request)
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
        )
        ->where('status', 'tunggu');
        
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
                $btn = '<button onclick="modalAction(\'' . url('/kompen/' . $kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Proses Verif</button> ';
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

    
    public function show_ajax(string $id)
    {
        $kompen = KompenModel::find($id);

        return view('admin.buat_kompen.show_ajax', ['kompen' => $kompen]);
    }

    public function updateStatus(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'status' => 'required|in:setuju,ditolak,pending', // Validasi status hanya menerima nilai tertentu
            'alasan' => 'required|string|max:255',
            
        ]);
    
        try {
            // Temukan data berdasarkan ID Pengajuan Kompen
            $kompen = KompenModel::findOrFail($request->id_kompen);
    
            // Update status
            $kompen->status = $request->status;
            $kompen->alasan = $request->alasan;
            $kompen->save();
    
            // Redirect dengan pesan sukses
            return redirect('/kompen')->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani error, misalnya jika data tidak ditemukan atau kesalahan lainnya
            return redirect('/kompen')->with('error', 'Terjadi kesalahan saat memperbarui status. ' . $e->getMessage());
        }
    }
    
}
