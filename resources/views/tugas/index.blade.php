
@extends('layouts.template')

@section('content')
<style>
    .no-border td, .no-border th {
    border: none !important;
    }

    .menu {
            display: flex;
            gap: 20px; /* Jarak antar tautan */
            font-family: Arial, sans-serif;
            justify-content: center;
            padding: 10px;
        }

        /* Gaya dasar untuk semua tautan */
        .menu a {
            text-decoration: none;
            color: #b0b0b0; /* Warna abu-abu untuk tautan yang tidak aktif */
            font-size: 18px;
            font-weight: normal;
        }

        /* Gaya untuk tautan yang aktif */
        .menu a.active {
            color: #333; /* Warna teks lebih gelap */
            font-weight: bold; /* Teks tebal */
            border-bottom: 5px solid #333; /* Garis bawah */
            padding-bottom: 2px; /* Jarak kecil antara teks dan garis bawah */
        }

</style>
<div class="col-12 text-left mb-3">
    <h2><b>Silahkan Cari Tugas Kompen yang tersedia</b></h2>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="form-group row"> 
        <div class="col-3">
            <select class="form-control" name="level_id" id="level_id" required>
                <option value="">Pilih Kompetensi</option>
                {{-- @foreach ($level as $item )
                <option value="{{$item->level_id}}">{{ $item->level_nama}}</option>
                @endforeach --}}
            </select>
        </div>
        </div>
    </div>
</div>
<br>
<div class="menu">
    <a href="#tugas-dosen">Tugas Dosen</a>
    <a href="#tugas-tendik" class="active">Tugas Tendik</a>
    <a href="#tugas-admin">Tugas Admin</a>
</div>
<br>
<div class="card card-outline ">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <table class="table table-striped table-hover table-sm mt-3 no-border" id="table_user">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Time</th>
                    <th>Detail</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Isi data tabel di sini -->
            </tbody>
        </table>
    </div>
</div>
  
@endsection

@push('js')
<!-- Chart.js -->
@endpush
