@extends('layouts.template')

@section('content')

<!-- Statistik Section -->
<div class="row mt-4">
    <!-- Box 1 -->
    {{-- <div class="col-lg-3 col-6">
        <div class="small-box bg-info position-relative shadow-sm" style="border: 2px solid #ffffff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="inner">
                <div class="icon" style="top: 50%; transform: translateY(-50%); right: 20px;">
                    <i class="fas fa-user fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{ $totalPersonil }}</h3>
                <p style="font-weight: bold; color:#ffffff">Total Personil Akademik</p>
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
                    <i class="fas fa-users fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{ $totalMahasiswa }}</h3>
                <p style="font-weight: bold; color:#ffffff">Total Mahasiswa</p>
            </div>
           
            <a href="{{ url('/mahasiswa') }}" class="small-box-footer" style="background: rgba(255,255,255,0.1); padding: 10px; font-weight: bold;">
                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div> --}}

    <!-- Box 3 -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary position-relative shadow-sm" style="border: 2px solid #ffffff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="inner">
                <div class="icon" style="top: 50%; transform: translateY(-50%); right: 20px;">
                    <i class="fas fa-tasks fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{$totalKompen}}</h3>
                <p style="font-weight: bold;color:#ffffff">Total Tugas Kompen</p>
            </div>

             
            <a href="{{ url('/kompen') }}" class="small-box-footer" style="background: rgba(255,255,255,0.1); padding: 10px; font-weight: bold;">
                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box 4 -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger position-relative shadow-sm" style="border: 2px solid #ffffff; border-radius: 10px; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="inner">
                <div class="icon" style="top: 50%; transform: translateY(-50%); right: 20px;">
                    <i class="fas fa-layer-group fa-3x text-white"></i>
                </div>
                <h3 style="font-size: 2.5rem;">{{$totalKompetensi}}</h3>
                <p style="font-weight: bold;color:#ffffff">Total Kompetensi</p>
            </div>
            <a href="{{ url('/kompetensi') }}" class="small-box-footer" style="background: rgba(255,255,255,0.1); padding: 10px; font-weight: bold;">
                Info lebih lanjut <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease-in-out;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>
@endpush
@endsection