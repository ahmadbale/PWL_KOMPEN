@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Personil Akademik</h3>
        <div class="card-tools">
            {{-- <a href="{{url('/user/export_excel')}}" class="btn btn-info"></i> Export Kategori Excel</a>
            <a href="{{url('/user/export_pdf')}}" class="btn btn-info btn-warning"></i>  Export Kategori PDF</a>
            <button onclick="modalAction('{{ url('/user/import') }}')" class="btn btn-info">Import User </button> --}}
            <button onclick="modalAction('{{ url('user/create_ajax') }}')" class="btn btn-success">Tambah User</button>
        </div>
    </div>
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
                                <option value="{{ $item->id_level }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Level Personil</small>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>No Hp</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
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

        var dataUser;
        $(document).ready(function() {
            dataUser = $('#table_personil_akademik').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.id_level = $('#id_level').val();
                    }
                },
                columns: [{
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },{
                    data: "id_personil",
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan
                    orderable: true,
                    // searchable: true, jika ingin kolom ini bisa dicari
                    searchable: true 
                },{
                    data: "no_induk",
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan
                    orderable: true,
                    // searchable: true, jika ingin kolom ini bisa dicari
                    searchable: true 
                },{
                    data: "username",
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan
                    orderable: true,
                    // searchable: true, jika ingin kolom ini bisa dicari
                    searchable: true
                }, {
                    data: "nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    // mengambil data level hasil dari ORM berelasi
                    data: "level.level_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "no_telp",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
                
            });

            $('#id_level').on('change', function() {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush