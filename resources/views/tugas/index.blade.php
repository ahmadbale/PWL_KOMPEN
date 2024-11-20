<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

@extends('layouts.template')
<head>
    <title>Kompen JTI | Polinema</title>
    <link rel="icon" href="logo-jti.png" type="image">
    </head>
@section('content')
<style>
    body{
        font-family: 'DM Sans', sans-serif;
    }

    .no-border td, .no-border th {
        border: none !important;
    }

    .position-relative {
    position: relative;
    }

    .custom-select {
    background-image: none;
    padding-right: 30px; /* Ruang untuk ikon */
    border-radius: 30px;
    background-color: rgba(217, 217, 217, 0.3);
    }

    .select-icon {
    position: absolute;
    right: 10px; /* Sesuaikan posisi ikon */
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none; /* Agar ikon tidak mengganggu klik */
    font-size: 16px; /* Ukuran ikon sesuai kebutuhan */
    color: #555; /* Sesuaikan warna ikon */
    padding-right: 15px;
    }
</style>
<body>
    <div class="cont">
        <div class="col-12 text-left mb-3">
            <h2><b>Silahkan Cari Tugas Kompen yang tersedia</b></h2>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-3 position-relative">
                        <select class="form-control custom-select" name="level_id" id="level_id" required>
                            <option value="">Pilih Kompetensi</option>
                            {{-- @foreach ($level as $item )
                            <option value="{{$item->level_id}}">{{ $item->level_nama}}</option>
                            @endforeach --}}
                        </select>
                        <!-- Icon Font Awesome -->
                        <i class="right fas fa-angle-down select-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        

        
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
                    <th>Nama Dosen / Tendik</th>
                    <th>Tugas</th>
                    <th>Jenis Tugas</th>
                    <th>Dateline</th>
                    <th>Konversi Jam Kompen</th>
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
</div>
@endsection

@push('js')
@endpush
