<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use App\Models\PersonilAkademikModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PersonilAkademikController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Personil Akademik',
            'list' => ['Home', 'personilakademik']
        ];

        $page = (object) [
            'title' => 'Daftar Personil Akademik yang terdaftar dalam sistem',
        ];

        $activeMenu = 'personilakademik'; // set menu yang sedang aktif
        $level = LevelModel::all(); //ambil data level untuk filter level
        return view('admin.personilakademik.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $personil = PersonilAkademikModel::select('id_personil', 'nomor_induk', 'username', 'nama', 'nomor_telp', 'id_level')
            ->with('level');

        if ($request->id_level) {
            $personil->where('id_level', $request->id_level);
        }
        return DataTables::of($personil)
            ->addIndexColumn()
            ->addColumn('aksi', function ($personil) {
                $btn = '<button onclick="modalAction(\'' . url('/personilakademik/' . $personil->id_personil . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/personilakademik/' . $personil->id_personil . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/personilakademik/' . $personil->id_personil . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function destroy(string $id)
    {
        $check = PersonilAkademikModel::find($id);
        if (!$check) {
            return redirect('/personilakademik')->with('error', 'Data Personil tidak ditemukan');
        }

        try {
            PersonilAkademikModel::destroy($id);
            return redirect('/personilakademik')->with('success', 'Data personil berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/personilakademik')->with('error', 'Data personil gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // CRUD AJAX
    public function create_ajax()
    {
        $level = LevelModel::select('id_level', 'nama_level')->get();
        return view('admin.personilakademik.create_ajax')->with('level', $level);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_level' => 'required|integer|nullable',
                'nomor_induk' => 'nullable|string|max:18|unique:personil_akademik,nomor_induk',
                'username' => 'nullable|string|max:20|unique:personil_akademik,username',
                'nama' => 'nullable|string|max:255',
                'password' => 'nullable|string|max:255',
                'nomor_telp' => 'nullable|string|max:15'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            try {
                // Encrypt the password before saving
                $data = $request->all();
                if (isset($data['password'])) {
                    $data['password'] = bcrypt($data['password']);
                }

                PersonilAkademikModel::create($data);

                return response()->json([
                    'status' => true,
                    'message' => 'Data Personil berhasil disimpan'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menyimpan data personil',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        return redirect('/');
    }

    public function show_ajax(string $id)
    {
        $personil = PersonilAkademikModel::find($id);
        return view('admin.personilakademik.show_ajax', ['personil' => $personil]);
    }

    public function edit_ajax(string $id)
    {
        $personil = PersonilAkademikModel::find($id);
        $level = LevelModel::select('id_level', 'nama_level')->get();
        return view('admin.personilakademik.edit_ajax', ['personil' => $personil, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_level' => 'required|integer|nullable',
                'nomor_induk' => 'nullable|string|max:18|unique:personil_akademik,nomor_induk',
                'username' => 'nullable|string|max:20|unique:personil_akademik,username',
                'nama' => 'nullable|string|max:255',
                'password' => 'nullable|string|max:255',
                'nomor_telp' => 'nullable|string|max:15'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            $personil = PersonilAkademikModel::find($id);
            if ($personil) {
                if (!$request->filled('password')) {
                    $request->request->remove('password');
                }
                $personil->update($request->all());
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

    public function confirm_ajax(string $id)
    {
        $personil = PersonilAkademikModel::find($id);
        return view('admin.personilakademik.confirm_ajax', ['personil' => $personil]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $personil = PersonilAkademikModel::find($id);
            if ($personil) {
                $personil->delete();
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

    public function jumalahPersonil()
    {
        $jumlahPersonil = PersonilAkademikModel::count('id_personil');
        return view('welcome', compact('jumlahPersonil'));
    }
}
