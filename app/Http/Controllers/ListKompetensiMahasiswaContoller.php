<?php

namespace App\Http\Controllers;
use App\Models\KompetensiModel;

use Illuminate\Http\Request;

class ListKompetensiMahasiswaContoller extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kompetensi Mahasiswa',
            'list' => ['Home', 'Kopetensi Mahasiswa']
        ];
        $page = (object) [
            'title' => 'Daftar Kopetensi yang Terdaftar dalam Sistem'
        ];

        $activeMenu = 'listkompenmahasiswa';
        $kompetensi = KompetensiModel::all();
        return view('admin.kompetensi.index', compact('breadcrumb', 'page', 'listkompenmahasiswa', 'activeMenu'));
    }

}
