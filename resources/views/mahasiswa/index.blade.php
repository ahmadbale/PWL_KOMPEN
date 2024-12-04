<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@extends('layouts.template')
<head>
    <title>Kompen JTI | Polinema</title>
    <link rel="icon" href="logo-jti.png" type="image">
</head>
<style>
     /* #text{
        padding-top: 0px;
    } */

    body {
        font-family: 'DM Sans', sans-serif;
    }

    .cont{
        padding-left: 2%;
        padding-right: 2%;
    }

    #text{
        padding-left: 0%;
    }

</style>
@section('content')
<div class="cont">
<div class="col-12 text-left mb-3" id="text">
    <h2><b>Tambah Data Mahasiswa</b></h2>
</div>
<body>
<div class="card-tools">
    <button onclick="modalAction('{{ url('/mahasiswa/create_ajax') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data
    </button> 
    <button onclick="modalAction('{{ url('/mahasiswa/import') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Import Data</button> 
    <a href="{{ url('/mahasiswa/export_excel') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Export Data</a>
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
                    <th>Periode</th>
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
</div>
</body>
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
                    className: "text-center", 
                    width: "9%", 
                    orderable: true, 
                    searchable: true, 
                },{ 
                    data: "nama",  
                    className: "", 
                    width: "15%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "semester",  
                    className: "text-center", 
                    width: "5%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "jam_alpha",  
                    className: "text-center", 
                    width: "10%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "jam_kompen",  
                    className: "text-center", 
                    width: "10%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "jam_kompen_selesai",  
                    className: "text-center", 
                    width: "15%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "prodi.nama_prodi",  
                    className: "text-center", 
                    width: "15%", 
                    orderable: true, 
                    searchable: true, 
                },
                { 
                    data: "aksi",  
                    className: "text-center", 
                    width: "20%", 
                    orderable: false, 
                    searchable: false 
                } 
            ] 
        });
        
        $('#table-mahasiswa_filter input').unbind().bind().on('keyup', function(e){         if(e.keyCode == 13){ // enter key             \
        tableBarang.search(this.value).draw();        
         }    
         }); 
 

    })
</script>

@endpush
