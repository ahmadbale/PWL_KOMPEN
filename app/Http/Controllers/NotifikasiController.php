<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $activeMenu = 'notifikasi';
        return view('admin.notifikasi.index',compact('activeMenu'));
    }
}
