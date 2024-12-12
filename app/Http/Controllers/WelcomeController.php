<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KompenModel;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $totalMahasiswa = MahasiswaModel::count();
        $totalKompen = KompenModel::count();
        $activeMenu = 'dashboard';
        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'totalMahasiswa' => $totalMahasiswa, 'totalKompen' => $totalKompen]);
    }

    public function index_admin() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];
        $totalMahasiswa = MahasiswaModel::count();
        $activeMenu = 'dashboard';
        $totalKompen = KompenModel::count();
        return view('dahsboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'totalMahasiswa' => $totalMahasiswa, 'totalKompen' => $totalKompen]);
    }

}