@extends('layouts.template')

@section('content')
<div class="row g-4">
    <!-- Pengguna Terdaftar -->
    <div class="col-lg-3 col-md-6">
        <div class="card h-100">
            <div class="card-body p-4" style="background: #3498db;">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="text-white">
                        <h6 class="mb-2">Pengguna Terdaftar</h6>
                        <div class="d-flex align-items-center gap-2">
                            <h2 class="mb-0">{{$totalMahasiswa}}</h2>
                        </div>
                    </div>
                    <i class="fas fa-users fa-2x text-white opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-white border-0 p-2">
                <a href="{{ url('/mahasiswa') }}" class="text-primary text-decoration-none d-block text-center">
                    Lihat Detail <i class="fas fa-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Progres Tugas -->
    <div class="col-lg-3 col-md-6">
        <div class="card h-100">
            <div class="card-body p-4" style="background: #2ecc71;">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="text-white">
                        <h6 class="mb-2">Total Tugas Kompen</h6>
                        <div class="d-flex align-items-center gap-2">
                            <h2 class="mb-0">{{$totalKompen}}</h2>
                        </div>
                    </div>
                    <i class="fas fa-tasks fa-2x text-white opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-white border-0 p-2">
                <a href="{{ url('/kompen') }}" class="text-success text-decoration-none d-block text-center">
                    Lihat Detail <i class="fas fa-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Notifikasi Baru -->
    <div class="col-lg-3 col-md-6">
        <div class="card h-100">
            <div class="card-body p-4" style="background: #f39c12;">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="text-white">
                        <h6 class="mb-2">Notifikasi Baru</h6>
                        <div class="d-flex align-items-center gap-2">
                            <h2 class="mb-0">44</h2>
                            <span class="badge bg-white text-warning">Belum Dibaca</span>
                        </div>
                    </div>
                    <i class="fas fa-bell fa-2x text-white opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-white border-0 p-2">
                <a href="" class="text-warning text-decoration-none d-block text-center">
                    Lihat Detail <i class="fas fa-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Masalah Dilaporkan -->
    <div class="col-lg-3 col-md-6">
        <div class="card h-100">
            <div class="card-body p-4" style="background: #e74c3c;">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="text-white">
                        <h6 class="mb-2">Masalah Dilaporkan</h6>
                        <div class="d-flex align-items-center gap-2">
                            <h2 class="mb-0">65</h2>
                            <span class="badge bg-white text-danger">Urgent</span>
                        </div>
                    </div>
                    <i class="fas fa-exclamation-triangle fa-2x text-white opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-white border-0 p-2">
                <a href="" class="text-danger text-decoration-none d-block text-center">
                    Lihat Detail <i class="fas fa-chevron-right ms-1"></i>
                </a>
            </div>
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