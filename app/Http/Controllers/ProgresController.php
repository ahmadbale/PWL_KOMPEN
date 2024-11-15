<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgresController extends Controller
{
    public function index()
    {
        $activeMenu = 'progres';
        return view('progres.index',compact('activeMenu'));
    }
}
