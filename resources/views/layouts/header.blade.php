<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="mr-2 d-flex align-items-center">
                    <img src="{{ auth()->user()->image ? asset('storage/photos/' . auth()->user()->image) : asset('image.png') }}" 
                         class="rounded-circle mr-2" 
                         style="width: 35px; height: 35px; object-fit: cover;" 
                         alt="{{ auth()->user()->username }}" />
                    <span class="text-dark d-none d-md-inline">
                        {{ auth()->user()->username }} / {{ auth()->user()->nama }}
                    </span>
                </div>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                <div class="dropdown-header d-flex align-items-center">
                    <img src="{{ auth()->user()->image ? asset('storage/photos/' . auth()->user()->image) : asset('image.png') }}" 
                         class="rounded-circle mr-3" 
                         style="width: 50px; height: 50px; object-fit: cover;" 
                         alt="{{ auth()->user()->username }}" />
                    <div>
                        <h6 class="m-0">{{ auth()->user()->username }}</h6>
                        <strong>{{ auth()->user()->level->nama_level }}</strong>
                    </div>
                </div>
                
                <div class="dropdown-divider"></div>
                
                @php
                    $profileRoutes = [
                        'MHS' => '/profile-mhs',
                        'ADM' => '/profile-pa',
                        'TDK' => '/profile-pa',
                        'DSN' => '/profile-pa'
                    ];
                @endphp

                @if(isset($profileRoutes[auth()->user()->level->kode_level]))
                    <a class="dropdown-item" href="{{ url($profileRoutes[auth()->user()->level->kode_level]) }}">
                        <i class="fas fa-user mr-2"></i> Edit Profile
                    </a>
                @endif

                <a class="dropdown-item text-danger" href="{{ url('/logout') }}" onclick="logout()">
                    <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                </a>
            </div>
        </li>
    </ul>
</nav>

@push('scripts')
<script>
    function logout() {
        // Clear authentication token
        localStorage.removeItem('authToken');
        
        // Redirect to logout endpoint
        window.location.href = '{{ url('logout') }}';
        
        // Optional: Show logout confirmation
        toastr.success('Anda telah berhasil logout!');
    }
</script>
@endpush