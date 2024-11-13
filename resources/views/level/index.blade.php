<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@extends('layouts.template')
<style>
    #text{
       padding-top: 50px;
   }

   body {
       font-family: 'DM Sans', sans-serif;
   }
</style>
@section('content')
<body>
<div class="col-12 text-left mb-3" id="text">
    <h2><b>Tambah Level</b></h2>
</div>
<div class="card-tools">
                {{-- <button onclick="modalAction('{{ url('/level/import') }}')" class="btn btn-info">Import Level</button>
                <a href="{{ url('/level/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Level</a>
                <a href="{{ url('/level/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Level</a> --}}
                <button onclick="modalAction('{{ url('level/create_ajax') }}')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data
                </button> 
</div>
<br>
 <div class="card card-outline card">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm no-border" id="table_level">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Level Kode</th>
                        <th>Level Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
</body>
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
        var dataLevel
        $(document).ready(function(){
            dataLevel = $('#table_level').DataTable({
                processing: true,
                //serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax:{
                    "url": "{{ url('level/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns:[
                    {
                        //nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },{
                        data: "kode_level",
                        className: "",
                        //orderable: true, jika ingin kolom bisa diurutkan
                        orderable: true,
                        //searchable: true, jika ingin kolom bisa dicari
                        searchable: true
                    },{
                        data: "nama_level",
                        className: "",
                        orderable:true,
                        searchable: true
                    },{
                        data: "aksi",
                        className: "",
                        orderable:false,
                        searchable: false
                    }
                ]
            });

            $('#table-level_filter input').unbind().bind().on('keyup', function(e){         if(e.keyCode == 13){ // enter key             \
        tableMahasiswa.search(this.value).draw();        
         }    
         }); 
 


        });
    </script>
@endpush