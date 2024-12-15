<?php
namespace App\Http\Controllers;

use App\Models\JenisKompenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JenisController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Jenis Kompen',
            'list' => ['Home', 'Jenis Kompen']
        ];
        $page = (object) [
            'title' => 'Daftar Jenis Kompen yang Terdaftar dalam Sistem'
        ];

        $activeMenu = 'jeniskompen';
        $jeniskompen = JenisKompenModel::all();
        return view('admin.jenis_kompen.index', compact('breadcrumb', 'page', 'jeniskompen', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $jeniskompen = JenisKompenModel::select('id_jenis_kompen', 'kode_jenis', 'nama_jenis');
        
        if ($request->has('id_jenis_kompen')) {
            $jeniskompen->where('id_jenis_kompen', $request->id_jenis_kompen);
        }

        return DataTables::of($jeniskompen)
        ->addIndexColumn()
        ->addColumn('aksi', function ($jeniskompen) {
            $btn = '<button onclick="modalAction(\'' . url('/jeniskompen/' . $jeniskompen->id_jenis_kompen 
            . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            
            $btn .= '<button onclick="modalAction(\'' . url('/jeniskompen/' . $jeniskompen->id_jenis_kompen
            . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    
    }

    public function destroy(string $id_jenis_kompen)
    {
        $check = jeniskompenmodel::find($id_jenis_kompen);
        if (!$check) {
            return redirect('/jeniskompen')->with('error', 'Data jenis kompen tidak ditemukan');
        }
        try {
            jeniskompenModel::destroy($id_jenis_kompen);
            return redirect('/jeniskompen')->with('success', 'Data jeniskompen berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/jeniskompen')->with('error', 'Data jeniskompen gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // Ajax
    public function create_ajax()
    {
        $jeniskompen = jeniskompenModel::select('id_jenis_kompen', 'kode_jenis', 'nama_jenis')->get();
        return view('admin.jenis_kompen.create_ajax', compact('jeniskompen'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_jenis' => 'required|string|max:5',
                'nama_jenis' => 'required|string|max:250'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            jeniskompenModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data jeniskompen berhasil disimpan.'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $jeniskompen = jeniskompenModel::find($id);
        return view('admin.jenis_kompen.edit_ajax', compact('jeniskompen'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_jenis' => 'required|string|max:255',
                'nama_jenis' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $jeniskompen = jeniskompenModel::find($id);
            if ($jeniskompen) {
                $jeniskompen->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
    public function confirm_ajax(string $id){
        $jeniskompen = jeniskompenModel::find($id);

        return view('admin.jenis_kompen.confirm_ajax', ['jeniskompen' => $jeniskompen]);
    }
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $jeniskompen = jeniskompenModel::find($id);
            if ($jeniskompen) {
                $jeniskompen->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
}