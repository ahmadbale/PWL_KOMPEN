<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $activeMenu = 'kategori';
        return view('kategori.index', compact('activeMenu'));
        
    }
}
