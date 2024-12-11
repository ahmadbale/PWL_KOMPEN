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
    
    .position-relative {
    position: relative;
    }
    
</style>
<body>
    <div class="cont">
        <div class="col-12 text-left mb-3">
            <h2><b>Silahkan Cari Tugas Kompen yang tersedia</b></h2>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-3 position-relative">
                        <select class="form-control custom-select" name="id_jenis_kompen" id="id_jenis_kompen" required>
                            <option value="">Pilih Jenis Kompen</option>
                            @foreach ($jeniskompen as $item )
                            <option value="{{$item->id_jenis_kompen}}">{{ $item->nama_jenis}}</option>
                            @endforeach
                        </select>
                        <!-- Icon Font Awesome -->
                        <i class="right fas fa-angle-down select-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        

        
<div class="card card-outline ">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped table-hover table-sm border" id="table_cari_kompen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen / Tendik</th>
                    <th>Tugas</th>
                    <th>Jenis Kompen</th>
                    <th>Kuota</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Konversi Jam Kompen</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Isi data tabel di sini -->
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
    .modal-dialog {
        max-width: 75%;
        margin: 1.75rem auto;
    }
    .table {
        width: 100% !important;
    }
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    function modalAction(url) {
        $('#myModal').load(url, function() {
            $(this).modal('show');
        });
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dataKompen = $('#table_cari_kompen').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/cari_kompen/list') }}",
                type: "POST",
                dataType: "json",
                data: function(d) {
                d.id_jenis_kompen = $('#id_jenis_kompen').val(); // Tambahkan nilai dropdown sebagai parameter
             },
                error: function(xhr, error, thrown) {
                    console.log('Error:', error);
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "personil.nama",  
                    className: "", 
                    width: "19%", 
                    orderable: true, 
                    searchable: true, 
                },
                {
                    data: "nama",
                    className: "",
                    width:"19%",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jeniskompen.nama_jenis",  
                    className: "", 
                    orderable: true, 
                    searchable: true, 
                },
                {
                    data: "kuota",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tanggal_mulai",
                    className: "",
                    orderable: true,
                    searchable: true,
                    render: function(data) {
                        return data ? moment(data).format('DD-MM-YYYY') : '-';
                    }
                },
                {
                    data: "tanggal_selesai",
                    className: "",
                    orderable: true,
                    searchable: true,
                    render: function(data) {
                        return data ? moment(data).format('DD-MM-YYYY') : '-';
                    }
                },
                {
                    data: "jam_kompen",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "status",
                    className: "text-center",
                    orderable: true,
                    searchable: true,
                    render: function(data) {
                        return data == 1 ? 'Aktif' : 'Nonaktif';
                    }
                }, 
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ],
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            order: [[1, 'asc']],
            language: {
                processing: "Memuat data...",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari total _MAX_ data)",
                search: "Cari:",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });

        $('#id_jenis_kompen').change(function() {
        dataKompen.ajax.reload(); // Reload data berdasarkan filter
    });
    });
</script>
@endpush

