@extends('layouts.template')

@section('content')

    <div class="col-12 text-left mb-3" id="text">
        <h2><b>Daftar Kompetensi Mahasiswa</b></h2>
    </div>

    <div class="card-tools">
    <button type="button" onclick="modalAction('{{ url('kompetensi_mahasiswa/create_ajax') }}')" class="btn btn-success">
        Tambah Kompetensi
    </button>
    </div>
    <br>
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

        <table class="table table-bordered table-striped table-hover table-sm " id="table_kompetensi_mahasiswa">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Kompetensi</th>
                    <th>Deskripsi Kompetensi</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal content will be loaded here -->
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

        var dataKompetensiMahasiswa = $('#table_kompetensi_mahasiswa').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('kompetensi_mahasiswa/list') }}",
                type: "POST",
                dataType: "json",
                error: function(xhr, error, thrown) {
                    console.log('Error:', error);
                }
            },
            columns: [{
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "nama_kompetensi",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "deskripsi_kompetensi",
                className: "",
                orderable: true,
                searchable: true
            }, {
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

        $('#myModal').on('hidden.bs.modal', function() {
            dataKompetensiMahasiswa.ajax.reload(null, false);
        });
    });
</script>
@endpush