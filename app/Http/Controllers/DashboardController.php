<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PersonilAkademikModel;
use App\Models\MahasiswaModel;
class DashboardController extends Controller
{
  
    public function index() {
    $activeMenu = 'dashboard';
     

       

       return view('dashboard',['activeMenu' => $activeMenu]);
       

    }
}
