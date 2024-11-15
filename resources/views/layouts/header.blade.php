
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <!-- Isi dengan link jika diperlukan -->
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <!-- Isi dengan link jika diperlukan -->
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" id="logout" href="#" role="button"><i class="fa fa-sign-out"></i></a>
        </li>
    </ul>
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Profile -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .avatar { width: 40px; height: 40px; object-fit: cover; }
            .dropdown-menu { min-width: 200px; }
            .user-info { font-size: 0.9rem; }
            #logout{
                padding-left:85rem;
            }

        </style>  
            <script>
              function logout() {
                localStorage.removeItem('authToken');
                window.location.href = '{{ url('logout')}}';
                alert('Anda telah berhasil logout!');
              }
            </script>
    </ul>
  </nav>