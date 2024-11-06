@extends('layouts.template')

@section('content')
<div class="col-12 text-left mb-3">
    <h2><b>Tambah Data Tendik</b></h2>
</div>

<div class="card-tools">
    <button onclick="modalAction('{{ url('/') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</button> 
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
                    <th>ID Tendik</th>
                    <th>Nama Lengkap</th>
                    <th>No Hp</th>
                    <th>NIP</th>
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
