<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KompenModel;
use App\Models\KompenDetailModel;
use App\Models\JenisKompenModel;

class HistoryKompenMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'title' => 'Histori Kompen',
            'list' => ['Home', 'Histori Kompen']
        ];

        $data = [
            'page_title' => 'Daftar Histori Kompen Jurusan Teknologi Informasi',
            'breadcrumb' => $breadcrumb,
            'jeniskompen' => JenisKompenModel::all(),
        ];

        return response()->json($data);
    }

    public function listKompen(Request $request)
    {
        $id = auth()->user()->id_mahasiswa;

        // Mengambil data kompen dengan tambahan kolom tanggal
        $kompens = KompenModel::with([
            'personil:id_personil,nama,username',
            'jeniskompen:id_jenis_kompen,nama_jenis',
            'detailkompen'
        ])
        ->whereHas('detailkompen', function ($query) use ($id) {
            $query->where('id_mahasiswa', $id);
        });

        if ($request->id_jenis_kompen) {
            $kompens->where('id_jenis_kompen', $request->id_jenis_kompen);
        }

        $result = $kompens->get()->map(function ($kompen) {
            return [
                'id_kompen' => $kompen->id_kompen,
                'nomor_kompen' => $kompen->nomor_kompen,
                'nama' => $kompen->nama,
                'deskripsi' => $kompen->deskripsi,
                'id_personil' => $kompen->id_personil,
                'id_jenis_kompen' => $kompen->id_jenis_kompen,
                'kuota' => $kompen->kuota,
                'jam_kompen' => $kompen->jam_kompen,
                'status' => $kompen->status,
                'is_selesai' => $kompen->is_selesai,
                'tanggal_mulai' => $kompen->tanggal_mulai ? $kompen->tanggal_mulai->format('Y-m-d') : null,
                'tanggal_selesai' => $kompen->tanggal_selesai ? $kompen->tanggal_selesai->format('Y-m-d') : null,
                'jenis_kompen' => $kompen->jeniskompen->nama_jenis ?? null,
            ];
        });

        return response()->json($result);
    }

    public function list()
    {
        $detailKompen = KompenDetailModel::with('kompen', 'mahasiswa.prodi')->get();
        return response()->json($detailKompen);
    }

    public function show($id)
    {
        $detailKompen = KompenDetailModel::where('id_kompen', $id)
            ->whereHas('mahasiswa', function ($query) {
                $query->where('id_mahasiswa', auth()->user()->id_mahasiswa);
            })
            ->with('mahasiswa', 'kompen')
            ->first();

        if (!$detailKompen) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($detailKompen);
    }

    public function updateProgres(Request $request, $id)
    {
        $request->validate([
            'progres_1' => 'required|string|max:255',
            'progres_2' => 'required|string|max:255',
        ]);

        try {
            $detailKompen = KompenDetailModel::findOrFail($id);

            $detailKompen->update([
                'progres_1' => $request->progres_1,
                'progres_2' => $request->progres_2,
            ]);

            return response()->json(['message' => 'Progres berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }
}
