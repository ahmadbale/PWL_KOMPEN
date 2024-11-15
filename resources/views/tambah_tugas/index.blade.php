<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

@extends('layouts.template')
<head>
    <title>Kompen JTI | Polinema</title>
    <link rel="icon" href="logo-jti.png" type="image">
    </head>

<style>
  body{
        font-family: 'DM Sans', sans-serif;
    }

    .cont{
        padding-left: 2%;
        padding-right: 2%;
    }
</style>

@section('content')

<body>
    <div class="cont">
<div class="card-tools">
    <div class="col-12 text-left mb-3" id="text">
        <h2><b>Submit Tugas</b></h2>
    </div>
    <button onclick="modalAction('{{ url('/') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Tugas</button> 
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
                    <th>No Hp</th>
                    <th>Dateline</th>
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
</body>
@endsection

@push('js')
<!-- Chart.js -->
@endpush
