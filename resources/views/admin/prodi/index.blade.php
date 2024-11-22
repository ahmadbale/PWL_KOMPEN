<style>
    .no-border td, .no-border th {
        border-color: black; 
        
  }
</style>
@extends('layouts.template')

@section('content')
<div class="card card-outline card">
    <div class="card-header">
        <h3 class="card-title">Daftar Prodi</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('prodi/create_ajax') }}')" class="btn btn-success">Tambah Personil</button>
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
        </div>
        <table class="table table-bordered table-striped table-hover table-sm no-border" id="table_prodi">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
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
                },{
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });

            $('#id_prodi').on('change', function() {
                dataProdi.ajax.reload();
            });
        });
    </script>
@endpush