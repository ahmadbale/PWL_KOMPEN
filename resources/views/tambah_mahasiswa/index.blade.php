
@extends('layouts.template')
<style>
     #text{
        padding-top: 50px;
    }
</style>
@section('content')
<div class="col-12 text-left mb-3" id="text">
    <h2><b>Tambah Data Mahasiswa</b></h2>
</div>

<div class="card-tools">
    <button onclick="modalAction('{{ url('/') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</button> 
    <button onclick="modalAction('{{ url('/') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Import Data</button> 
    <a href="{{ url('/') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Export Data</a>
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
                    <th>ID Mahasiswa</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>NIM</th>
                    <th>Aksi</th>
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
