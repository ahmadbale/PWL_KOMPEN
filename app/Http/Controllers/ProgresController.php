<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgresController extends Controller
{
    public function index()
    {
        return view('progres.index');
    }
}
