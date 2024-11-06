<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiTugasController extends Controller
{
    public function index()
    {
        return view('verfikasi_tugas.index');
    }
}
