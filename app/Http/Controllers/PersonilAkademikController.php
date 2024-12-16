<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use App\Models\PersonilAkademikModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;


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

        $personil->whereHas('level', function ($q) {
            $q->where('nama_level', '!=', 'Mahasiswa');
        });

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
                'username' => 'nullable|string|max:20',
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

    public function import()
    {
        return view('admin.personilakademik.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [                 // validasi file harus xls atau xlsx, max 1MB                
                'file_personil' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            $file = $request->file('file_personil');  // ambil file dari request 

            $reader = IOFactory::createReader('Xlsx');  // load reader file excel             
            $reader->setReadDataOnly(true);             // hanya membaca data            
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel             
            $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif 

            $data = $sheet->toArray(null, false, true, true);   // ambil data excel 

            $insert = [];
            if (count($data) > 1) { // jika data lebih dari 1 baris                 
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // baris ke 1 adalah header, maka lewati                         
                        $insert[] = 
                        [
                         'nomor_induk' => $value['A'],
                         'username' => $value['B'],
                         'nama' => $value['C'], 
                         'password' => bcrypt($value['D']), 
                         'nomor_telp' => $value['E'], 
                         'id_level' => $value['F'],
                         'created_at' => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {                     // insert data ke database, jika data sudah ada, maka diabaikan                     
                    PersonilAkademikModel::insertOrIgnore($insert);
                }

                return response()->json(['status' => true, 'message' => 'Data berhasil diimport']);
            } else {
                return response()->json(['status' => false, 'message' => 'Tidak ada data yang diimport']);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        $personil = PersonilAkademikModel::select('nomor_induk','nama','nomor_telp','id_level')
        ->orderBy('id_level')
        ->with('level')
        ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nomor Induk');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'No Telepon');
        $sheet->setCellValue('E1', 'Level Pengguna');
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($personil as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->nomor_induk);
            $sheet->setCellValue('C' . $baris, $value->nama);
            $sheet->setCellValue('D' . $baris, $value->nomor_telp);
            $sheet->setCellValue('E' . $baris, $value->level->nama_level);
            $baris++;
            $no++;
        }

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Personil Akademik');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Personil Akademik' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $personil = PersonilAkademikModel::select('nomor_induk','nama','nomor_telp','id_level')
        ->orderBy('id_level')
        ->with('level')
        ->get();

        $pdf = Pdf::loadView('admin.personilakademik.export_pdf', ['personil'=> $personil]);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();

        return $pdf->stream('Data Personil Akademik '.date('Y-m-d H:i:s').'.pdf');
    }
    
}
