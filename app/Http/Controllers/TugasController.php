<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $activeMenu = 'tugas';
        return view('tugas.index',compact('activeMenu'));
    }
}
