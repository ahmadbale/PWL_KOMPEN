@extends('layouts.template')

@section('content')
<div class="cont">
    <div class="col-12 text-center mb-3" id="text">
        <h2><b>Dashboard Kompen JTI</b></h2>
    </div>

    <!-- Statistik Kehadiran -->
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-times-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Alpha</span>
                    <span class="info-box-number" id="alphaCount">5</span> <!-- Data statis -->
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-credit-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Kompensasi</span>
                    <span class="info-box-number" id="kompensasiCount">10</span> <!-- Data statis -->
                </div>
            </div>
        </div>
    </div>

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
    
    <!-- Donut Chart -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Statistik Kehadiran</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="chart-responsive">
                        <canvas id="attendanceDonutChart" height="200"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                        <li><i class="far fa-circle text-danger"></i> Alpha</li>
                        <li><i class="far fa-circle text-warning"></i> Kompensasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function () {
        const alpha = 5; // Data Alpha
        const kompensasi = 10; // Data Kompensasi
        const total = alpha + kompensasi;

        // Update counts
        document.getElementById('alphaCount').textContent = alpha;
        document.getElementById('kompensasiCount').textContent = kompensasi;

        // Donut Chart
        const ctx = document.getElementById('attendanceDonutChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Alpha', 'Kompensasi'],
                datasets: [{
                    data: [alpha, kompensasi],
                    backgroundColor: ['#dc3545', '#ffc107'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

@push('js')
<!-- Chart.js -->
@endpush

<head>
    <title>Kompen JTI | Polinema</title>
    <link rel="icon" href="logo-jti.png" type="image">
</head>

<style>
    body {
        font-family: 'DM Sans', sans-serif;
    }

    .no-border td, .no-border th {
        border: none !important;
    }   

    #text {
        padding-bottom: 50px;
    }

    .cont {
        padding-left: 2%;
        padding-right: 2%;
    }
</style>
