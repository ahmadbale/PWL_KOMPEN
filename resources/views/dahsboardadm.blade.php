@extends('layouts.template')

@section('content')
{{-- 
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, Apakabar?</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        Selamat datang, Ini adalah halaman utama dari aplikasi ini.
    </div>
</div> --}}

<!-- Statistik Section -->
<div class="row mt-4">
    <!-- Box 1 -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info position-relative shadow-sm" style="border: 2px solid #ffffff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="inner">
                <div class="icon" style="top: 50%; transform: translateY(-50%); right: 20px;">
                    <i class="fas fa-users fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{ $totalPersonil }}</h3>
                <p style="font-weight: bold;">Total Personil Akademik</p>
            </div>
         
            <a href="{{ url('/personilakademik') }}" class="small-box-footer" style="background: rgba(255,255,255,0.1); padding: 10px; font-weight: bold;">
                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box 2 -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success position-relative shadow-sm" style="border: 2px solid #ffffff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="inner">
                <div class="icon" style="top: 50%; transform: translateY(-50%); right: 20px;">
                    <i class="fas fa-tasks fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{ $totalMahasiswa }}</h3>
                <p style="font-weight: bold;">Total Mahasiswa</p>
            </div>
           
            <a href="{{ url('/mahasiswa') }}" class="small-box-footer" style="background: rgba(255,255,255,0.1); padding: 10px; font-weight: bold;">
                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box 3 -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning position-relative shadow-sm" style="border: 2px solid #ffffff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="inner">
                <div class="icon" style="top: 50%; transform: translateY(-50%); right: 20px;">
                    <i class="fas fa-bell fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{$totalKompen}}</h3>
                <p style="font-weight: bold;">Total Tugas Kompen</p>
            </div>
            <a href="/notifications" class="small-box-footer" style="background: rgba(255,255,255,0.1); padding: 10px; font-weight: bold;">
                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box 4 -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger position-relative shadow-sm" style="border: 2px solid #ffffff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="inner">
                <div class="icon" style="top: 50%; transform: translateY(-50%); right: 20px;">
                    <i class="fas fa-exclamation-triangle fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{$totalKompetensi}}</h3>
                <p style="font-weight: bold;">Total Kompetensi</p>
            </div>
            <a href="{{ url('/kompetensi') }}" class="small-box-footer" style="background: rgba(255,255,255,0.1); padding: 10px; font-weight: bold;">
                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

@endsection
