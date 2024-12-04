<?php

namespace App\Http\Controllers;

use App\Models\KompenModel;
use Illuminate\Http\Request;

class PengajuanKeAdminController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pengajuan Kompen Ke Admin',
            'list' => ['Home', 'Pengajuan Kompen']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan Kompen Jurusan Teknologi Informasi'
        ];

        $activeMenu = 'pengajuankompenadmin';
        $kompens = KompenModel::all();
        return view('admin.verif_admin.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kompens' => $kompens,
            'activeMenu' => $activeMenu
        ]);
    }

    

}
