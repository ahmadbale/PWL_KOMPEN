<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use App\Models\PengajuanKompenModel;
use App\Models\PersonilAkademikModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class CariKompenController extends Controller
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

       
        $activeMenu = 'cari_tugas';
        $jeniskompen = JenisKompenModel::all();
        $kompens = KompenModel::all();
        $personil = PersonilAkademikModel::all();
        return view('mahasiswa.cari_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompens' => $kompens,
            'activeMenu' => $activeMenu,
            'jeniskompen' => $jeniskompen,
            'personil' => $personil
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
        )
        ->where('status', 'setuju')
        ->whereRaw('(SELECT COUNT(*) FROM pengajuan_kompen WHERE pengajuan_kompen.id_kompen = kompen.id_kompen AND pengajuan_kompen.status != "ditolak") < kompen.kuota');
        
        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }elseif ($request->id_personil) {
            $kompens->where('id_personil',$request->id_personil);
        }
        
        return DataTables::of($kompens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($cari_kompen) {
                $btn = '<button onclick="modalAction(\'' . url('/cari_kompen/' . $cari_kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
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
        return redirect('/mahasiswa');
    }

    public function show_ajax(string $id)
    {
        $kompen = KompenModel::find($id);

        return view('mahasiswa.cari_kompen.show_ajax', ['kompen' => $kompen]);
    }
    

    public function store_pengajuan(Request $request)
    {
        // Ensure the request is an AJAX or JSON request
        if ($request->ajax() || $request->wantsJson()) {
            // Validation rules
            $rules = [
                'id_kompen' => 'required'
            ];
    
            // Validate the incoming request
            $validator = Validator::make($request->all(), $rules);
    
            // If validation fails, return error response
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            // Find the kompen
            $kompen = KompenModel::find($request->id_kompen);
    
            // Check if kompen exists
            if (!$kompen) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kompen tidak ditemukan.'
                ], 404);
            }
    
            // Check if quota is full
            $currentPengajuan = PengajuanKompenModel::where('id_kompen', $request->id_kompen)
                ->where('status', '!=', 'ditolak')
                ->count();
    
            if ($currentPengajuan >= $kompen->kuota) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kuota sudah terpenuhi'
                ]);
            }
    
            // Check if the kompen is already submitted by the current user
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
    
            // Prepare pengajuan data
            $pengajuan = [
                'id_kompen' => $request->id_kompen,
                'id_mahasiswa' => auth()->user()->id_mahasiswa,
                'status' => 'pending',
            ];
    
            // Create the pengajuan record
            PengajuanKompenModel::create($pengajuan);
    
            // Return success response
            return response()->json([
                'status' => true,
                'message' => 'Pengajuan kompen berhasil disimpan.'
            ], 200);
        }
    
        // If not an AJAX request, redirect to home
        return redirect('/cari_kompen')->with('error', 'Akses tidak sah.');
    }

}