<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KompenModel;
use Illuminate\Http\Request;
use App\Models\PersonilAkademikModel;
use App\Models\KompetensiModel;
use App\Models\JenisKompenModel;
class WelcomeController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $totalPersonil = PersonilAkademikModel::count();
        $totalMahasiswa = MahasiswaModel::count();
        $totalKompen = KompenModel::count();
        $totalKompetensi = KompetensiModel::count();
        $totalJenisKompen = JenisKompenModel::count();

        $activeMenu = 'dahsboardadm';
        return view('dahsboardadm', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu,'totalPersonil' => $totalPersonil,'totalMahasiswa' => $totalMahasiswa,'totalKompen' => $totalKompen,'totalKompetensi' => $totalKompetensi,'totalJenisKompen' => $totalJenisKompen]);
    }

}   