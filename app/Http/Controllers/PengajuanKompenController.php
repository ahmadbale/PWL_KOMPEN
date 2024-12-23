<?php

namespace App\Http\Controllers;

use App\Models\KompenDetailModel;
use App\Models\PengajuanKompenModel;
use App\Models\KompenModel;
use App\Models\JenisKompenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PengajuanKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pengajuan Kompen',
            'list' => ['Home', 'Pengajuan']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan Kompen Jurusan Teknologi Informasi'
        ];

        $activeMenu = 'pengajuan_kompen';
        $jeniskompen = JenisKompenModel::all();
        $pengajuan_kompen = PengajuanKompenModel::all();
        return view('admin.pengajuan_kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'pengajuan_kompen' => $pengajuan_kompen,
            'jeniskompen' => $jeniskompen,
            'activeMenu' => $activeMenu
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
            )->where('status', 'setuju')
            ->where('is_selesai', 0);

        if (auth()->user()->level->kode_level !== 'ADM') {
            $kompens->where('id_personil', auth()->user()->id_personil);
        }


        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }

          
        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }

        // $kompens = $kompens->get();

        return DataTables::of($kompens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kompen) {
                $btn = '<button onclick="modalAction(\'' . url('/pengajuankompen/' . $kompen->id_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Lihat Pengajuan</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function list(Request $request)
    {
        $pengajuankompen = PengajuanKompenModel::select(
            'id_pengajuan_kompen',
            'id_kompen',
            'id_mahasiswa',
            'status'
        )
            ->with([
                'kompen',
                'mahasiswa' => function ($query) {
                    $query->select('id_mahasiswa', 'nama', 'id_prodi', 'jam_kompen');
                },
                'mahasiswa.prodi',
                'mahasiswa.kompetensi_mahasiswa.kompetensi' // Ambil relasi sampai ke tabel kompetensi
            ])
            ->get();

        return DataTables::of($pengajuankompen)
            ->addIndexColumn()
            ->addColumn('kompetensi_mahasiswa', function ($pengajuankompen) {
                // Akses kompetensi melalui relasi mahasiswa -> kompetensi_mahasiswa -> kompetensi
                $kompetensiMahasiswa = $pengajuankompen->mahasiswa->kompetensi_mahasiswa ?? [];

                // Ambil nama kompetensi
                $kompetensiList = collect($kompetensiMahasiswa)->map(function ($km) {
                    return $km->kompetensi->nama_kompetensi ?? '-';
                })->implode(', ');

                return $kompetensiList;
            })
            ->addColumn('prodi', function ($pengajuankompen) {
                return $pengajuankompen->mahasiswa->prodi->nama_prodi ?? '-'; // Tampilkan nama prodi atau tanda "-"
            })
            ->addColumn('aksi', function ($pengajuankompen) {
                $btn = '<button onclick="modalAction(\'' . url('/pengajuankompen/' . $pengajuankompen->id_pengajuan_kompen . '/show_ajax') . '\')" class="btn btn-info btn-sm">Pengajuan Kompen</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax($id)
    {
        $pengajuankompen = PengajuanKompenModel::select('id_pengajuan_kompen', 'id_kompen', 'id_mahasiswa', 'status')
            ->where('id_kompen', $id)
            ->with('mahasiswa', 'kompen')
            ->get();
        $kompen = KompenModel::find($id);

        return view('admin.pengajuan_kompen.show_ajax', ['pengajuankompen' => $pengajuankompen, 'kompen' => $kompen]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,acc,reject',
        ]);

        $pengajuankompen = PengajuanKompenModel::findOrFail($request->id_pengajuan_kompen);

        // Cek apakah status sudah final (acc atau reject)
        if ($pengajuankompen->status == 'acc' || $pengajuankompen->status == 'reject') {
            return redirect('/pengajuankompen')->with('error', 'Status tidak dapat diubah lagi.');
        }

        // Cek apakah status sedang diubah
        if ($pengajuankompen->status != $request->status) {
            // Update status
            $pengajuankompen->status = $request->status;

            // Buat record baru di tabel 'detail_kompen' jika status berubah menjadi 'acc'
            if ($request->status == 'acc') {
                KompenDetailModel::create([
                    'id_kompen' => $request->id_kompen,
                    'id_mahasiswa' => $request->id_mahasiswa,
                ]);
            }
            // Hapus record di tabel 'pengajuan_kompen' jika status ditolak
            elseif ($request->status == 'reject') {
                $pengajuankompen->delete();

                return redirect('/pengajuankompen')->with('success', 'Pengajuan kompen berhasil ditolak');
            }

            $pengajuankompen->save();

            return redirect('/pengajuankompen')->with('success', 'Status berhasil diperbarui.');
        } else {
            return redirect('/pengajuankompen')->with('error', 'Status tidak ada perubahan.');
        }
    }
}