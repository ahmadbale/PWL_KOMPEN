<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use Yajra\DataTables\Facades\DataTables;

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
        return view('cari_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompens' => $kompens,
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
        );

        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
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

    public function show_ajax(string $id)
    {
        $kompens = KompenModel::find($id);
        return view('cari_kompen.show_ajax', compact('cari_kompen'));
    }

}
