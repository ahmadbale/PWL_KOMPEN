<?php
namespace App\Http\Controllers;

use App\Models\KompetensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KompetensiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kompetensi',
            'list' => ['Home', 'Kopetensi']
        ];
        $page = (object) [
            'title' => 'Daftar Kopetensi yang Terdaftar dalam Sistem'
        ];

        $activeMenu = 'kompetensi';
        $kompetensi = KompetensiModel::all();
        // return view('admin.kompetensi.index', compact('breadcrumb', 'page', 'kompetensi', 'activeMenu' => $activeMenu));
        return view('admin.kompetensi.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $kompetensi = KompetensiModel::select('id_kompetensi', 'nama_kompetensi', 'deskripsi_kompetensi');

        if ($request->has('id_kompetensi')) {
            $kompetensi->where('id_kompetensi', $request->id_kompetensi);
        }

        return DataTables::of($kompetensi)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kompetensi) {
            $btn = '<button onclick="modalAction(\'' . url('/kompetensi/' . $kompetensi->id_kompetensi 
            . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            
            $btn .= '<button onclick="modalAction(\'' . url('/kompetensi/' . $kompetensi->id_kompetensi 
            . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function destroy(string $id_kompetensi)
    {
        $check = Kompetensimodel::find($id_kompetensi);
        if (!$check) {
            return redirect('/kompetensi')->with('error', 'Data Kompetensi tidak ditemukan');
        }
        try {
            KompetensiModel::destroy($id_kompetensi);
            return redirect('/kompetensi')->with('success', 'Data Kompetensi berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kompetensi')->with('error', 'Data Kompetensi gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // Ajax
    public function create_ajax()
    {
        $kompetensi = KompetensiModel::select('id_kompetensi', 'nama_kompetensi')->get();
        return view('admin.kompetensi.create_ajax', compact('kompetensi'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kompetensi' => 'required|string|max:100',
                'deskripsi_kompetensi' => 'required|string|max:250'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            KompetensiModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data Kompetensi berhasil disimpan.'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $kompetensi = KompetensiModel::find($id);
        return view('admin.kompetensi.edit_ajax', compact('kompetensi'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kompetensi' => 'required|string|max:255',
                'deskripsi_kompetensi' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $kompetensi = KompetensiModel::find($id);
            if ($kompetensi) {
                $kompetensi->update($request->all());
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
        $kompetensi = KompetensiModel::find($id);

        return view('admin.kompetensi.confirm_ajax', ['kompetensi' => $kompetensi]);
    }
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kompetensi = KompetensiModel::find($id);
            if ($kompetensi) {
                $kompetensi->delete();
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