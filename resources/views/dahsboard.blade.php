<!DOCTYPE html>
@extends('layouts.template')
@section('content')
<div class="container">
    <h2>Dashboard Dosen</h2>
   
    <!-- Debug Data -->
    <script>
        console.log('Status Data Raw:', @json($statusData));
    </script>
   
    <!-- Chart Section -->
    <div class="row my-4">
        <div class="col-md-6">
            <canvas id="jumlahDitolakChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="totalJamChart"></canvas>
        </div>
    </div>

    <!-- Table Section -->
    <h4>Data Kompensasi</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor Kompen</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Jam Kompen</th>
                <th>Status</th>
                <th>Selesai</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kompenData as $data)
            <tr>
                <td>{{ $data->nomor_kompen }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->deskripsi }}</td>
                <td>{{ $data->jam_kompen }}</td>
                <td>{{ ucfirst($data->status) }}</td>
                <td>{{ $data->is_selesai ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $data->tanggal_mulai }}</td>
                <td>{{ $data->tanggal_selesai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Prepare data
    const statusData = @json($statusData);
   
    // Jumlah Kompensasi Ditolak Chart
    const ctxJumlah = document.getElementById('jumlahDitolakChart').getContext('2d');
    
    // Pisahkan data ditolak dan disetujui
    const ditolakData = statusData.find(item => item.status === 'ditolak');
    const disetujuData = statusData.find(item => item.status === 'setuju');
    
    const labels = ['Ditolak', 'Disetujui'];
    const values = [
        ditolakData ? ditolakData.total : 0, 
        disetujuData ? disetujuData.total : 0
    ];

    new Chart(ctxJumlah, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Kompensasi',
                data: values,
                backgroundColor: ['#ff5722', '#4caf50'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah Kompensasi per Status'
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Kompensasi'
                    }
                }
            }
        }
    });

    // Total Jam Chart
    const ctxJam = document.getElementById('totalJamChart').getContext('2d');
    const jamValues = [
        ditolakData ? ditolakData.total_jam : 0, 
        disetujuData ? disetujuData.total_jam : 0
    ];

    new Chart(ctxJam, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Jam Kompensasi',
                data: jamValues,
                backgroundColor: ['#ff5722', '#4caf50'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Total Jam Kompensasi per Status'
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Jam'
                    }
                }
            }
        }
    });
</script>
@endsection