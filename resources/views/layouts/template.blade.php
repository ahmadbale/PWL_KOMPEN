<!DOCTYPE html>
<html lang="en">
    <style>
        .main-sidebar {
            background-color: #ffffff;
            transition: width 0.3s ease, background-color 0.3s ease !important;
            position:fixed !important;
        }

        .content{
            background-color: #F1F3FC!important;
        }
        .logo{
            padding-top: 3%;
            padding-bottom: 5px;
            display: flex;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            width: 40%;  
        }
    .sub {
    margin-left: auto;
    margin-right: auto; /* Menempatkan elemen di tengah secara horizontal */
    font-family: 'DM Sans', sans-serif; /* Memastikan font yang tepat */
    font-size: 20px; /* Ukuran font */
    color: black; /* Warna teks */
    text-align: center; 
    padding-bottom: 10%; 
    }
     
    </style>
<head>
        <title>Kompen JTI | Polinema</title>
        <link rel="icon" href="logo-jti.png" type="image">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'KOMPEN') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('/')}}/plugins/fontawesome-free/css/all.min.css">
    {{-- contoh link
    <link rel="stylesheet" href="{{ url('/')}}/plugins/fontawesome-free/css/all.min.css"> --}}
    
    {{-- Database --}}
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.minss">
    <link rel="stylesheet" href="{{ url('/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- SweetAlert2 --}}
    {{-- <link rel="stylesheet" href="{{asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}} "> --}}
    <link rel="stylesheet" href="{{url('/')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('/')}}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
         @include('layouts.header') 
       <!-- /.navbar --> 

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar" >
             <!-- Brand Logo -->
         <a href="{{ url('/') }}">
        <img class="logo img-circle" src="{{ asset('logo-jti.png')}}" alt="">
       </a>
       <h1 class="sub">KOMPEN</h1>
            <!-- Brand Logo -->
            <!-- Sidebar -->
            @include('layouts.sidebar')
            <!-- /.sidebar -->
        </aside>
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- @include('layouts.breadcrumb') --}}

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        {{-- @include('layouts.footer') --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    {{-- <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ url('/')}}/plugins/jquery/jquery.min.js"></script>
    {{-- contoh link
    <script src="{{ url('/')}}/plugins/jquery/jquery.min.js"></script> --}}

    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ url('/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    {{-- Database & plugins --}}
    {{-- <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colvis.min.js') }}"></script> --}}

    <script src="{{ url('/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('/')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('/')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('/')}}/plugins/datatables-buttons/js/buttons.colvis.min.js"></script>
    {{-- jQuery-validation --}}
    {{-- <script src="{{asset('adminlte/plugins/jquery-validation/jquery.validate.min.js')}} "></script>
    <script src="{{asset('adminlte/plugins/jquery-validation/additional-methods.min.js')}}"></script> --}}
    <script src="{{url('/')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/plugins/jquery-validation/additional-methods.min.js"></script>
    {{-- SweetAlert2 --}}
    {{-- <script src="{{asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script> --}}
    <script src="{{url('/')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script> --}}
    <script src="{{ url('/')}}/dist/js/adminlte.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        $.ajaxSetup({headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});
    </script>
    @stack('js')
</body>

</html>