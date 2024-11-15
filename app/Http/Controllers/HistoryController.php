<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $activeMenu = 'history';
        return view('history.index',compact('activeMenu'));
    }
}
