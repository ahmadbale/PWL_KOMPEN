<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahTugasController extends Controller
{
    public function index()
    {
        $activeMenu = 'tambah_tugas';
        return view('tambah_tugas.index',compact('activeMenu'));
    }
}
