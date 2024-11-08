
@extends('layouts.template')
<style>
     #text{
        padding-top: 50px;
    }
</style>
@section('content')

<div class="col-12 text-left mb-3" id="text">
    <h2><b>Tambah Data Mahasiswa</b></h2>
</div>

<div class="card-tools">
    <button onclick="modalAction('{{ url('/mahasiswa/create_ajax') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data
    </button> 
    <button onclick="modalAction('{{ url('/') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Import Data</button> 
    <a href="{{ url('/') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Export Data</a>
</div>
<br>
<div class="card card-outline ">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
       
        <table class="table table-striped table-hover table-sm mt-3 no-border" id="table_mahasiswa">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Induk</th>
                    <th>Nama Lengkap</th>
                    <th>Semester</th>
                    <th>Jam Alpha</th>
                    <th>Jam Kompen</th>
                    <th>Jam Kompen Selesai</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Isi data tabel di sini -->
            </tbody>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
function modalAction(url = ''){     
    $('#myModal').load(url,function(){       
          $('#myModal').modal('show');     
        }); 
    }

    var dataMahasiswa;
    $(document).ready(function() {
        dataMahasiswa = $('#table_mahasiswa').DataTable({
            serverSide:true,
            ajax: {
                "url": "{{ url('mahasiswa/list') }}",
                "dataType": "json",
                "type" : "POST",
                "data" : function (d){
                    d.id_mahasiswa = $('#id_mahasiswa').val();
                }
         },

         columns: [
            {
                        //nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        width: "5%",
                        orderable: false,
                        searchable: false
                },{ 
                    data: "nomor_induk",  
                    className: "", 
                    width: "10%", 
                    orderable: true, 
                    searchable: true, 
                },{ 
                    data: "nama",  
                    className: "", 
                    width: "20%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "semester",  
                    className: "", 
                    width: "5%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "jam_alpha",  
                    className: "", 
                    width: "10%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "jam_kompen",  
                    className: "", 
                    width: "10%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "jam_kompen_selesai",  
                    className: "", 
                    width: "5%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "prodi.nama_prodi",  
                    className: "", 
                    width: "19%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "aksi",  
                    className: "", 
                    width: "20%", 
                    orderable: false, 
                    searchable: false 
                } 
            ] 


        })
    })
</script>

@endpush
