<!DOCTYPE html>
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
                    <span class="info-box-text">Total Alpha</span>
                    <span class="info-box-number" id="alphaCount">{{ $totalAlpha }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-credit-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Kompensasi</span>
                    <span class="info-box-number" id="kompensasiCount">{{ $totalKompensasi }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline" id="card-outline-id">
        <div class="card-body" id="card-body-id">
            <table class="table table-striped table-hover table-sm mt-3 no-border" id="table_user">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Alpha</th>
                        <th>Total Kompensasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kompensasiData as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->jam_alpha }}</td>
                        <td>{{ $data->jam_kompen }}</td>
                    </tr>
                    @endforeach
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

@push('scripts')
<script>
    var totalAlpha = {{ $totalAlpha }};
    var totalKompensasi = {{ $totalKompensasi }};
    
    var ctx = document.getElementById('attendanceDonutChart').getContext('2d');
    var attendanceDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Alpha', 'Kompensasi'],
            datasets: [{
                data: [totalAlpha, totalKompensasi],
                backgroundColor: ['#dc3545', '#ffc107'], // Red for Alpha, Yellow for Kompensasi
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var label = tooltipItem.label || '';
                            if (label) {
                                label += ': ' + tooltipItem.raw;
                            }
                            return label;
                        }
                    }
                }
            }
        }z
    });
</script>
@endpush

