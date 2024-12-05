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
        )->where('status','setuju');
        
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
                $btn = '<button onclick="modalAction(\'' . url('/histori_kompen/' . $kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Pekerja</button> ';
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
                $detailkompen = KompenDetailModel::select('id_kompen_detail', 'id_kompen','id_mahasiswa', 'progres_1', 'progres_2')
                ->where('id_kompen', $id)
                ->with('mahasiswa', 'kompen')
                ->get();
                $kompen = KompenModel::find($id);
        
                return view('admin.histori_kompen.show_ajax', ['detailkompen' => $detailkompen, 'kompen' => $kompen]);
                
            }
}
