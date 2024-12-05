@extends('layouts.template')
<style>

    .cont{
        padding-left: 2%;
        padding-right: 2%;
    }
</style>
@section('content')
<div class="cont">
        <div class="col-12 text-left mb-3">
            <h2><b>Daftar Pengajuan Kompen Jurusan Teknologi Informasi</b></h2>
        </div>
<div class="card card-outline card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3 position-relative">
                        <select class="form-control custom-select" name="id_pengajuan_kompen" id="id_pengajuan_kompen" required>
                            <option value="">Pilih Status Kompen</option>
                            @foreach ($pengajuan_kompen as $item)
                                <option value="{{ $item->id_pengajuan_kompen }}">{{ $item->status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_pengajuan_kompen">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Kompen</th>
                    <th>Mahasiswa</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Konten modal akan dimuat di sini -->
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

        var dataPengajuanKompen = $('#table_pengajuan_kompen').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('pengajuankompen/list') }}",
                type: "POST",
                dataType: "json",
                data: function(d) {
                        d.id_pengajuan_kompen = $('#id_pengajuan_kompen')
                    .val(); // Tambahkan nilai dropdown sebagai parameter
                    },
                error: function(xhr, error, thrown) {
                    console.error('Error:', error);
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
                    data: "kompen.nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "mahasiswa.nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "status",
                    className: "",
                    orderable: true,
                    searchable: true
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
        $('#id_pengajuan_kompen').change(function() {
                dataPengajuanKompen.ajax.reload(); // Reload data berdasarkan filter
            });
    });
</script>
@endpush
