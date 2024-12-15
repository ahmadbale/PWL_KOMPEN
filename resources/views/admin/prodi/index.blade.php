<style>
    /* .no-border td, .no-border th {
        border-color: black; 
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
            <h2><b>Daftar Prodi</b></h2>
        </div>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('prodi/create_ajax') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Prodi</button>
        </div>
    <br>
    <div class="card card-outline card">
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
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="id_prodi" name="id_prodi" required>
                            <option value="">- Semua -</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id_prodi }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Data prodi</small>
                </div>
            </div>
        </div> --}}
        <table class="table table-bordered table-striped table-hover table-sm" id="table_prodi">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    {{-- <th>Aksi</th> --}}
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

        var dataProdi;
        $(document).ready(function() {
            dataProdi = $('#table_prodi').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('prodi/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.id_prodi = $('#id_prodi').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },{
                    data: "kode_prodi",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "nama_prodi",
                    className: "",
                    orderable: true,
                    searchable: true
                 }
                //,{
                //     data: "aksi",
                //     className: "",
                //     orderable: false,
                //     searchable: false
                // }
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

            $('#id_prodi').on('change', function() {
                dataProdi.ajax.reload();
            });
        });
    </script>
@endpush