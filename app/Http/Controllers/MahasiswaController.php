<?php

namespace App\Http\Controllers;

use App\Models\ProdiModel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar Mahasiswa',
            'list' => ['Home', 'Mahasiswa']
        ];

        $page = (object)[
            'title' => 'Daftar Mahasiswa Jurusan Teknoloogi Informasi'
        ];

        $activeMenu = 'mahasiswa';
        $prodi = ProdiModel::all();
        return view('mahasiswa.index', ['breadcrumb' => $breadcrumb,
            'page' => $page,
            'prodi' => $prodi,
            'activeMenu' => $activeMenu
        ]);
    }
}
