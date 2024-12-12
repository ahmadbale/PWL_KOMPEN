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
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Profile -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            .avatar { width: 40px; height: 40px; object-fit: cover; }
            .dropdown-menu { min-width: 200px; }
            .user-info { font-size: 0.9rem; }
        </style>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{  auth()->user()->image ? asset('storage/photos/' . auth()->user()->image) : asset('image.png ')}}" class="avatar img-fluid rounded-circle" style="width: 30px; height: 30px;"
                alt="{{auth()->user()->username}}" /> <span class="text-dark">
                  {{auth()->user()->username}}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
              <div class="px-4 py-3">
                  {{-- profile Dropdown --}}
                  <div class="d-flex align-items-center">
                    <small class="text-muted"><strong>
                        {{ auth()->user()->level->nama_level}}
                    </strong>
                    </small>
                  </div>
              </div>
              <div class="dropdown-divider"></div>
              @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "MHS")
              <a class="dropdown-item py-2" href="{{ url('/profile-mhs') }}">
                <i class="fas fa-user me-2"></i> Edit Profile
              </a>
              @endif
              @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "ADM")
              <a class="dropdown-item py-2" href="{{ url('/profile-pa') }}">
                <i class="fas fa-user me-2"></i> Edit Profile
              </a>
              @endif
              @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "TDK")
              <a class="dropdown-item py-2" href="{{ url('/profile-pa') }}">
                <i class="fas fa-user me-2"></i> Edit Profile
              </a>
              @endif
              @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "DSN")
              <a class="dropdown-item py-2" href="{{ url('/profile-pa') }}">
                <i class="fas fa-user me-2"></i> Edit Profile
              </a>
              @endif

              <a class="dropdown-item py-2" href="{{ url('/login')}}" onclick="logout()">
                  <i class="fas fa-sign-out-alt me-2"></i> Log Out
              </a>
          </div>
            <script>
              function logout() {
                localStorage.removeItem('authToken');
                window.location.href = '{{ url('logout')}}';
                alert('Anda telah berhasil logout!');
              }
            </script>
    </ul>
  </nav>