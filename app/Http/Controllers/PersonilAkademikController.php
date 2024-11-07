<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use App\Models\PersonilAkademikModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class PersonilAkademikContoller extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Personil Akademik',
            'list' => ['Home', 'personilakademik']
        ];

        $page = (object) [
            'title' => 'Daftar Personil Akademik yang terdaftar dalam sistem',
        ];

        $activeMenu = 'personilakademik'; // set menu yang sedang aktif
        $level = LevelModel::all(); //ambil data level untuk filter level
        return view('personilakademik.index', ['breadcrumb' => $breadcrumb, 
        'page' => $page,
        'level' => $level,
        'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $user = PersonilAkademikModel::select('id_personil', 'username', 'nama', 'id_level')
            ->with('level');

        if ($request->id_level){
            $user->where('id_level',$request->id_level);
        }
        return DataTables::of($user)
            // Ambil data user dalam bentuk json untuk datables
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/personil/' . $user->id_personil) . '" class="btn btn-info btnsm">Detail</a> ';
                $btn .= '<a href="' . url('/personil/' . $user->id_personil . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/personil/' . $user->id_personil) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->id_personil .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_personil .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_personil .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Table View
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Personil',
            'list' => ['Home', 'Personil', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Form Tambah Personil',
        ];

        $level = LevelModel::all(); // Ambil data level untuk ditampilkan di form
        $activeMenu = 'personilakademik'; // Set menu yang sedang aktif

        return view('personilakademik.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik ditabel m_user komol username
            'username' =>'required|string|min:3|unique:m_user,username',
            'nama'     =>'required|string|max:100',
            'password' => 'required|min:5',
            'id_level' =>'required|integer'
        ]);

        PersonilAkademikModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' =>  bcrypt($request->password),
            'id_level' => $request->id_level
        ]);

        return redirect('/personilakademik')-> with('success', 'Data Personil berhasil dsimpan');
    }
    public function show(string $id){
        $user = PersonilAkademikModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Personil',
            'list' => ['Home','Personil','Detail']
        ];

        $page = (object)[
            'title'=>'Detail Personil'
        ];

        $activeMenu = 'personilakademik';
        return view('personilakademik.show',['breadcrumb' =>$breadcrumb,'page'=>$page,'personilakademik'=>$user, 'activeMenu'=>$activeMenu]);
    }

    public function edit(string $id){
        $user = PersonilAkademikModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Personil',
            'list' => ['Home', 'Personil', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Personil'
        ];

        $activeMenu = 'personilakademik'; // set menu yang sedang aktif
        return view('personilakademik.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'personilakademik' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:personil_akademik,username,' . $id . ',personil_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'id_level' => 'required|integer'
        ]);

        $user = PersonilAkademikModel::find($id);
        
        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'id_level' => $request->id_level
        ]);
        return redirect('/personilakademik')->with('success', 'Data Personil berhasil diubah');
    }

    public function destroy(string $id){
        $check = PersonilAkademikModel::find($id);
        if(!$check){
            return redirect('/personilakademik')->with('error','Data Personil tidak ditemukan');
        }

        try{
            PersonilAkademikModel::destroy($id);
            return redirect('/personilakademik')->with('success', 'Data personil berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect('/personilakademik')->with('error','Data personil gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    //CRUD AJAX
    public function create_ajax() {
        $level = LevelModel::select('id_level', 'nama_level')->get();
        return view('personilakademik.create_ajax')->with('level', $level);
    }
    public function store_ajax(Request $request) {
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_level' => 'required|integer',
                'username' => 'required|string|min:3|unique:personil_akademik,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];
            // use Illuminate\Support\Facades\Validation;
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }
            PersonilAkademikModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data Personil berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function show_ajax(string $id)
    {
        $user = PersonilAkademikModel::find($id);
        return view('personilakademik.show_ajax', ['personilakademik' => $user]);
    }
    public function edit_ajax(string $id)
    {
        $user = PersonilAkademikModel::find($id);
        $level = LevelModel::select('id_level', 'nama_level')->get();
        return view('personilakademik.edit_ajax', ['personilakademik' => $user, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        //cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_level' => 'required|integer',
                'username' => 'required|max:20|unique:personil_akademik,username,' .$id. ',user_id',
                'nama' => 'required|max:100',
                'password' => 'nullable|min:6|max:20'
            ];
            // use Illuminate\Support\Facades\Validation;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }
            $check = PersonilAkademikModel::find($id);
            if ($check) {
                if (!$request->filled('password')) { // jika password tidak diisi, maka hapus dari request
                    $request->request->remove('password');
                }
                $check->update($request->all());
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

    public function confirm_ajax(string $id) {
        $user = PersonilAkademikModel::find($id);
        return view('personilakademik.confirm_ajax', ['personilakademik' => $user]);
    }

    public function delete_ajax(Request $request, $id) {
        //cek apakah request dari ajax
        if($request->ajax() || $request->wantsJson()) {
            $user = PersonilAkademikModel::find($id);
            if($user) {
                $user->delete();
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