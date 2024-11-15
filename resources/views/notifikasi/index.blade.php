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
        background-color: #ffffff;
        padding: 20px;
    }

    .notification-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 20px;
        border-bottom: 1px solid #e6e6e6;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-text {
        font-size: 1rem;
    }

    .notification-time {
        color: #999;
        font-size: 0.875rem;
        text-align: right;
        padding-left:30rem;
    }

    .btn-lihat {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        font-weight: bold;
        width:10rem;

    }

    .btn-lihat:hover {
        background-color: #218838;
    }

    .view-all {
        text-align: center;
        padding: 15px;
        background-color: #e2edff;
    }

    .view-all a {
        color: #4a90e2;
        font-weight: bold;
        text-decoration: none;
    }

    .view-all a:hover {
        text-decoration: underline;
    }

    .cont{
        padding-left: 2%;
        padding-right: 2%;
    }

</style>
<body>
<div class="cont">
<div class="col-12 text-left mb-3 text-notif">
    <h2><b>Notifikasi</b></h2>
</div>

<div class="card card-outline">
    <div class="card-body">
        <!-- Notifikasi 1 -->
        <div class="notification-item">
            <div class="notification-text">
                <strong>Pesan dari Pak Enggar</strong><br>
                Your kompen has Accept
            </div>
            <div class="notification-time">
                1 day
            </div>
            <button type="button" class="btn btn-lihat">Lihat</button>
        </div>

        <!-- Notifikasi 2 -->
        <div class="notification-item">
            <div class="notification-text">
                <strong>Pesan dari Admin</strong><br>
                Your kompen has Accept
            </div>
            <div class="notification-time">
                2 days
            </div>
            <button type="button" class="btn btn-lihat">Lihat</button>
        </div>

        <!-- Notifikasi 3 -->
        <div class="notification-item">
            <div class="notification-text">
                <strong>Pesan dari Pak Banni</strong><br>
                Your kompen has Accept
            </div>
            <div class="notification-time">
                3 days
            </div>
            <button type="button" class="btn btn-lihat">Lihat</button>
        </div>

        <!-- Notifikasi 4 -->
        <div class="notification-item">
            <div class="notification-text">
                <strong>Pesan dari Pak Sholikin</strong><br>
                Your kompen has Unaccept
            </div>
            <div class="notification-time">
                4 days
            </div>
            <button type="button" class="btn btn-lihat">Lihat</button>
        </div>
    </div>

    <div class="view-all">
        <a href="#">View All</a>
    </div>
</div>
</div>
</body>
@endsection

@push('js')
<!-- Chart.js -->
@endpush
