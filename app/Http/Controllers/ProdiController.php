<?php

namespace App\Http\Controllers;

use App\Models\ProdiModel;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Prodi',
            'list' => ['Home', 'prodi']
        ];
        $page = (object) [
            'title' => 'Daftar Prodi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'Prodi';
        $prodi = Prodimodel::all();
        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'Prodi' => $prodi, 'activeMenu' => $activeMenu]);
    }
}
