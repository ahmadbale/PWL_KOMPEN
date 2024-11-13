<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProdiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Prodi',
            'list' => ['Home', 'Prodi']
        ];
        $page = (object) [
            'title' => 'Daftar Prodi'
        ];

        $activeMenu = 'prodi';
        $prodi = ProdiModel::all();
        return view('prodi.index', compact('breadcrumb', 'page', 'prodi', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $prodi = ProdiModel::select('id_prodi', 'kode_prodi', 'nama_prodi');

        if ($request->id_prodi) {
            $prodi->where('id_prodi', $request->id_prodi);
        }

        return DataTables::of($prodi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($prodi) {
                $btn = '<button onclick="modalAction(\'' . url('/prodi/' . $prodi->id_prodi 
                . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/prodi/' . $prodi->id_prodi 
                . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/prodi/' . $prodi->id_prodi 
                . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function destroy(string $id_prodi)
    {
        $check = ProdiModel::find($id_prodi);
        if (!$check) {
            return redirect('/prodi')->with('error', 'Data Prodi tidak ditemukan');
        }
        try {
            levelmodel::destroy($id_prodi);
            return redirect('/prodi')->with('success', 'Data prodi berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/prodi')->with('error', 'Data prodi gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // Ajax
    public function create_ajax()
    {
        $prodi = ProdiModel::select('id_prodi','kode_prodi', 'nama_prodi')->get();
        return view('prodi.create_ajax', compact('prodi'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_prodi' => 'required|string|min:3|unique:prodi,kode_prodi',
                'nama_prodi' => 'required|string|max:250'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            ProdiModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan.'
            ]);
        }

        return redirect('/');
    }

    public function show_ajax(string $id)
    {
        $prodi = ProdiModel::find($id);
        return view('prodi.show_ajax', compact('prodi'));
    }

    public function edit_ajax(string $id)
    {
        $prodi = ProdiModel::find($id);
        return view('prodi.edit_ajax', compact('prodi'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_prodi' => 'required|string|min:3|unique:prodi,kode_prodi,' . $id . ',id_prodi',
                'nama_prodi' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $prodi = ProdiModel::find($id);
            if ($prodi) {
                $prodi->update($request->all());
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
        $prodi = ProdiModel::find($id);

        return view('prodi.confirm_ajax', ['prodi' => $prodi]);
    }
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $prodi = ProdiModel::find($id);
            if ($prodi) {
                $prodi->delete();
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