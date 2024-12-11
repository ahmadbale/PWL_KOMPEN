@extends('layouts.template')

@section('content')
   
<div class="col-12 text-left mb-3">
    <h2><b>Daftar Histori Kompen</b></h2>
</div>
        <div class="card card-outline card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-3 position-relative">
                            <select class="form-control custom-select" name="id_jenis_kompen" id="id_jenis_kompen" required>
                                <option value="">Pilih Jenis Kompen</option>
                                @foreach ($jeniskompen as $item)
                                    <option value="{{ $item->id_jenis_kompen }}">{{ $item->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 position-relative">
                            <select class="form-control custom-select" name="id_jenis_kompen" id="id_jenis_kompen" required>
                                <option value="">Status Pengerjaan</option>
                                @foreach ($kompens as $item)
                                    <option value="{{ $item->id_kompen }}">{{ $item->is_selesai}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kompen">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nomor Kompen</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Kuota</th>
                        <th>Jam Kompen</th>
                        <th>Pengerjaan</th>
                        <th>Jenis Kompen</th>
                        <th>Diberikan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
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

            const dataKompen = $('#table_kompen').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/histori_selesai/list_kompen') }}",
                    type: "POST",
                    dataType: "json",
                    data: function(d) {
                        d.id_jenis_kompen = $('#id_jenis_kompen').val(); // Tambahkan nilai dropdown sebagai parameter
                        d.is_selesai = $('#is_selesai').val();
                    },
                    error: function(xhr, error) {
                        console.error('Error:', error);
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nomor_kompen"
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "deskripsi"
                    },
                    {
                        data: "kuota",
                        className: "text-center"
                    },
                    {
                        data: "jam_kompen",
                        className: "text-center"
                    },
                    {
                        data: "is_selesai",
                        className: "text-center",
                        render: function(data) {
                            return data === 1 ? 'Selesai' : 'Progress';
                        }
                    },
                    {
                        data: "jeniskompen.nama_jenis"

                    },
                    {
                        data: "personil.nama"
                    },
                    {
                        data: "tanggal_mulai",
                        render: function(data) {
                            return data ? moment(data).format('DD-MM-YYYY HH:mm:ss') : '-';
                        }
                    },
                    {
                        data: "tanggal_selesai",
                        render: function(data) {
                            return data ? moment(data).format('DD-MM-YYYY HH:mm:ss') : '-';
                        }
                    },
                    {
                        data: "status",
                        render: function(data) {
                            switch (data) {
                                case 'Tunggu':
                                    return `<span class="badge badge-warning">${data}</span>`;
                                case 'Setuju':
                                    return `<span class="badge badge-success">${data}</span>`;
                                case 'Ditolak':
                                    return `<span class="badge badge-danger">${data}</span>`;
                                default:
                                    return `<span class="badge badge-secondary">${data}</span>`;
                            }
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
                order: [
                    [1, 'asc']
                ],
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

            $('#id_jenis_kompen, #is_selesai').change(function() {
                dataKompen.ajax.reload(); // Reload data berdasarkan filter
            });
        });
    </script>
@endpush
