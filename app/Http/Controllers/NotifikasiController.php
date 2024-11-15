<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $activeMenu = 'notifikasi';
        return view('notifikasi.index',compact('activeMenu'));
    }
}
