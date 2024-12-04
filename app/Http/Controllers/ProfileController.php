<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $activeMenu = 'profile';
        return view('admin.profile.index',compact('activeMenu'));
    }
}
