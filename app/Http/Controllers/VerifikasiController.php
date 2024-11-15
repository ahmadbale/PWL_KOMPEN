<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $activeMenu = 'verifikasi';
        return view('verifikasi.index',compact('activeMenu'));
    }
}
