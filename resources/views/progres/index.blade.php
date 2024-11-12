<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@extends('layouts.template')
<head>
    <title>Kompen JTI | Polinema</title>
    <link rel="icon" href="logo-jti.png" type="image">
    </head>
@section('content')
<style>
     body {
        font-family: 'DM Sans', sans-serif;
    }

    .no-border td, .no-border th {
    border: none !important;
}

</style>
<div class="col-12 text-left mb-3">
    <h2><b>Tugas Progress</b></h2>
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
                    <th>ID Tugas</th>
                    <th>Nama Dosen / Tendik</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Deadline</th>
                    <th>Detail Progres</th>
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
