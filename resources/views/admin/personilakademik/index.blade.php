<style>
        /* .border td, .border th {
        border: 1pt solid black !important;
        } */

        .cont{
        padding-left: 2%;
        padding-right: 2%;
    }

    #text{
        padding-left: 0%;
    }
</style>
@extends('layouts.template')
@section('content')
<div class="cont">
<div class="col-12 text-left mb-3" id="text">
    <h2><b>Daftar Personil Akademik</b></h2>
</div>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('personilakademik/create_ajax') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</button>
            <button onclick="modalAction('{{ url('/personilakademik/import') }}')" class="btn btn-success"> Import Data</button> 
            <a href="{{ url('/personilakademik/export_excel') }}" class="btn btn-success"> <i class="fa fa-file-excel"></i> Export Data</a>
            <a href="{{ url('/personilakademik/export_pdf') }}" class="btn btn-success"><i class="fa fa-file-pdf"></i> Export Data</a> 
        </div>
<br>
<div class="card card-outline ">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="id_level" name="id_level" required>
                            <option value="">- Semua -</option>
                            @foreach ($level as $item)
                                @if ($item->nama_level !== 'Mahasiswa') <!-- Cek jika nama level bukan Mahasiswa -->
                                    <option value="{{ $item->id_level }}">{{ $item->nama_level }}</option>
                                @endif
                            @endforeach
                        </select>             
                        <small class="form-text text-muted">Level Pengguna</small>           
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm border " id="table_personilakademik">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nomor Induk</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataPersonil;
        $(document).ready(function() {
            dataPersonil = $('#table_personilakademik').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('personilakademik/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.id_level = $('#id_level').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    width: "5%"
                },{
                    data: "nomor_induk",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "username",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "nomor_telp",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "level.nama_level",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }],
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

            $('#id_level').on('change', function() {
                dataPersonil.ajax.reload();
            });
        });
    </script>
@endpush