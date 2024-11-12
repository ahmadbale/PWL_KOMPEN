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
    
.card.card-outline {
        border-radius: 2rem; /* Contoh: Mengubah radius border */
    }


</style>
<div class="col-12 text-center mb-3">
    <h1>Pengaturan</h1>
</div>
<body>
<div class="card card-outline ">
<div class="card-body">
  <div class="akun">
    <h1>Akun</h1>
    <nav class="mt-2">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p class="p1">
            Masukkan Data
        </p>
    </a>
    </nav>
  </div>


     
  <br>
  <br>


  <div class="akun">
    <h1>Lainnya</h1>
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p class="p1">
            Bantuan
        </p>
    </a>
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p class="p1">
            Kebijakan Privasi
        </p>
    </a>
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p class="p1">
            Keluar
        </p>
    </a>
  </div>
 

</div>
</div>
</body>
@endsection

@push('js')
<!-- Chart.js -->
@endpush
