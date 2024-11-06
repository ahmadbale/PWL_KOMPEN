<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TendikController extends Controller
{
    public function index()
    {
        return view('tambah_tendik.index');
    }
}
