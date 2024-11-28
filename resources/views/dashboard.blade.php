<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<head>
<title>Kompen JTI | Polinema</title>
<link rel="icon" href="logo-jti.png" type="image">
</head>
@extends('layouts.template')
@section('content')
<style>

    body {
        font-family: 'DM Sans', sans-serif;
    }

    .no-border td, .no-border th {
    border: none !important;
    }   

    #text{
        padding-bottom: 50px;
    }
    
    .cont{
        padding-left: 2%;
        padding-right: 2%;
    }
    
</style>
<div class="cont">
<div class="col-12 text-center mb-3" id="text">
    <h2><b>Dashboard Kompen JTI</b></h2>
</div>
<body>
<div class="card card-outline" id="card-outline-id">
    <div class="card-body" id="card-body-id">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped table-hover table-sm mt-3 no-border" id="table_user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Alpha</th>
                    <th>Total Kompensasi</th>
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
