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
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th class="text-center">Alpha</th>
                        <th class="text-center">Total Kompensasi</th>
                        <th class="text-center">Total Kompensasi Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kompensasiData as $index => $data)
                    <tr>
                        <td class="text-center">{{ $data->jam_alpha }}</td>
                        <td class="text-center">{{ $data->jam_kompen }}</td>
                        <td class="text-center">{{ $data->jam_kompen_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

