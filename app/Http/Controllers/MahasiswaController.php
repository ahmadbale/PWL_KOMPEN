<?php

namespace App\Http\Controllers;

use App\Models\ProdiModel;
use App\Models\LevelModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Mahasiswa',
            'list' => ['Home', 'Mahasiswa']
        ];

        $page = (object) [
            'title' => 'Daftar Mahasiswa Jurusan Teknoloogi Informasi'
        ];

        $activeMenu = 'mahasiswa';
        $prodi = ProdiModel::all();
        $mahasiswa = MahasiswaModel::all();
        $level = LevelModel::all();
        return view('admin.mahasiswa.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $mahasiswa = MahasiswaModel::select('id_mahasiswa', 'nomor_induk', 'username', 'nama', 'periode_tahun', 'jam_alpha', 'jam_kompen', 'jam_kompen_selesai', 'id_prodi')->with('prodi');

        if ($request->id_mahasiswa) {
            $mahasiswa->where('id_mahasiswa', $request->id_mahasiswa);
        }


        return DataTables::of($mahasiswa)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($mahasiswa) {
                $btn = '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create_ajax()
    {
        $prodi = ProdiModel::select('id_prodi', 'nama_prodi')->get();
        // $level = LevelModel::select('id_level', 'nama_level')->get();

        return view('admin.mahasiswa.create_ajax')
            ->with('prodi', $prodi);
        // -> with('level', $level);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nomor_induk' => 'required|max:10|unique:mahasiswa,nomor_induk',
                'username' => 'required',
                'nama' => 'required',
                'periode_tahun' => 'required',
                'password' => 'required',
                'jam_alpha' => 'required',
                'jam_kompen' => 'required',
                'jam_kompen_selesai' => 'required',
                'id_prodi' => 'required',
                // 'id_level' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            MahasiswaModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data Mahasiswa berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function detail_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $mahasiswa = MahasiswaModel::find($id);
            if ($mahasiswa) {
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
        $mahasiswa = MahasiswaModel::find($id);

        return view('admin.mahasiswa.show_ajax', ['mahasiswa' => $mahasiswa]);
    }

    public function edit_ajax(string $id)
    {
        $mahasiswa = MahasiswaModel::find($id);
        $prodi = ProdiModel::select('id_prodi', 'nama_prodi')->get();

        return view('admin.mahasiswa.edit_ajax', ['mahasiswa' => $mahasiswa, 'prodi' => $prodi]);
    }

    public function update_ajax(Request $request, string $id)
    {
        // Cek apakah request berasal dari AJAX atau JSON
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nomor_induk' => 'required',
                'username' => 'required',
                'nama' => 'required',
                'periode_tahun' => 'required',
                'password' => 'sometimes',
                'id_prodi' => 'required',
            ];

            // Menggunakan Validator untuk validasi input
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Respon JSON: true = berhasil, false = gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Menampilkan error per field
                ]);
            }


            $check = MahasiswaModel::find($id);
            if ($check) {
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

        return redirect('/mahasiswa');
    }

    public function confirm_ajax(string $id)
    {
        $mahasiswa = MahasiswaModel::find($id);

        return view('admin.mahasiswa.confirm_ajax', ['mahasiswa' => $mahasiswa]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $mahasiswa = MahasiswaModel::find($id);
            if ($mahasiswa) {
                $mahasiswa->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import()
    {
        return view('admin.mahasiswa.import');
    }
   
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [                 // validasi file harus xls atau xlsx, max 1MB                
                'file_mahasiswa' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            $file = $request->file('file_mahasiswa');  // ambil file dari request 

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
                         'periode_tahun' => $value['D'], 
                         'password' => $value['E'], 
                         'jam_alpha' => $value['F'], 
                         'id_prodi' => $value['G'],
                         'created_at' => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {                     // insert data ke database, jika data sudah ada, maka diabaikan                     
                    MahasiswaModel::insertOrIgnore($insert);
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
        $mahasiswa = MahasiswaModel::select('nomor_induk','nama','username','periode_tahun','jam_alpha','jam_kompen','jam_kompen_selesai','id_prodi')
        ->orderBy('nama')
        ->with('prodi')
        ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nomor Induk');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Username');
        $sheet->setCellValue('E1', 'periode_tahun');
        $sheet->setCellValue('F1', 'Jam Alpha');
        $sheet->setCellValue('G1', 'Jam Kompen');
        $sheet->setCellValue('H1', 'Jam Kompen Selesai');
        $sheet->setCellValue('I1', 'Prodi');

        $sheet->getStyle('A1:I1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->nomor_induk);
            $sheet->setCellValue('C' . $baris, $value->nama);
            $sheet->setCellValue('D' . $baris, $value->username);
            $sheet->setCellValue('E' . $baris, $value->periode_tahun);
            $sheet->setCellValue('F' . $baris, $value->jam_alpha);
            $sheet->setCellValue('G' . $baris, $value->jam_kompen);
            $sheet->setCellValue('H' . $baris, $value->jam_kompen_selesai);
            $sheet->setCellValue('I' . $baris, $value->prodi->nama_prodi);
            $baris++;
            $no++;
        }

        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Mahasiswa');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Mahasiswa' . date('Y-m-d H:i:s') . '.xlsx';

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
    

}