<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiTugasController extends Controller
{
    public function index()
    {
        $activeMenu = 'verifikasi_tugas';
        return view('verfikasi_tugas.index',compact('activeMenu'));
    }
}
