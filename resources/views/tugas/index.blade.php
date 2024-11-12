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

    .menu {
        display: flex;
        gap: 20px; /* Jarak antar tautan */
        font-family: Arial, sans-serif;
        justify-content: left;
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

    /* Sembunyikan konten tabel secara default */
    .table-content {
        display: none;
    }

    /* Tampilkan konten tabel yang aktif */
    .table-content.active {
        display: block;
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


<br>

<div class="menu">
    <a href="#tugas-dosen" data-target="tugas-dosen">Tugas Dosen</a>
    <a href="#tugas-tendik" data-target="tugas-tendik" class="active">Tugas Tendik</a>
    <a href="#tugas-admin" data-target="tugas-admin">Tugas Admin</a>
</div>

<br>

<div class="card card-outline">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Konten Tugas Dosen -->
        <div id="tugas-dosen" class="table-content">
            <table class="table table-striped table-hover table-sm mt-3 no-border" id="table_dosen">
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
                    <!-- Isi data tabel untuk Tugas Dosen di sini -->
                </tbody>
            </table>
        </div>

        <!-- Konten Tugas Tendik -->
        <div id="tugas-tendik" class="table-content active">
            <table class="table table-striped table-hover table-sm mt-3 no-border" id="table_tendik">
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
                    <!-- Isi data tabel untuk Tugas Tendik di sini -->
                </tbody>
            </table>
        </div>

        <!-- Konten Tugas Admin -->
        <div id="tugas-admin" class="table-content">
            <table class="table table-striped table-hover table-sm mt-3 no-border" id="table_admin">
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
                    <!-- Isi data tabel untuk Tugas Admin di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
@endsection

@push('js')
<script>
    // Menangani klik pada menu untuk menampilkan tabel yang sesuai
    document.querySelectorAll('.menu a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Menghapus kelas 'active' dari semua tautan dan tabel
            document.querySelectorAll('.menu a').forEach(a => a.classList.remove('active'));
            document.querySelectorAll('.table-content').forEach(content => content.classList.remove('active'));

            // Menambahkan kelas 'active' pada tautan dan tabel yang diklik
            this.classList.add('active');
            const target = this.getAttribute('data-target');
            document.getElementById(target).classList.add('active');
        });
    });
</script>
@endpush
