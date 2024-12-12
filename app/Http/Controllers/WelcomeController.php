<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonilAkademikModel;
use App\Models\MahasiswaModel;
use App\Models\KompenModel;
use App\Models\KompetensiModel;
class WelcomeController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';
        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function index_admin() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $totalPersonil = PersonilAkademikModel::count();
        $totalMahasiswa = MahasiswaModel::count();
        $totalKompen = KompenModel::count();
        $totalKompetensi = KompetensiModel::count();

        $activeMenu = 'dashboard_admin';
        return view('dahsboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu,'totalPersonil' => $totalPersonil,'totalMahasiswa' => $totalMahasiswa,'totalKompen' => $totalKompen,'totalKompetensi' => $totalKompetensi]);
    }

}