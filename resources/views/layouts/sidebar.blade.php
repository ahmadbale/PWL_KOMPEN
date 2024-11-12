<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<div class="sidebar">
    <!-- Sidebar Search Form -->
    {{-- <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}
    <style>
        p,i{
        color:black;
        }

        ion-icon {
      --ionicon-stroke-width: 50px;
        }
    </style>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/dashboard') }}" class="nav-link ">
            <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p class="p1">
                  Manage Data Personil
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p class="p1">
                  Masukkan Data
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ url('/mahasiswa') }}" class="nav-link {{ (  'level') ? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Mahasiswa</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ url('/tambahdosen') }}" class="nav-link {{ (  'user') ? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Dosen</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ url('/tambahtendik') }}" class="nav-link {{ (  'user') ? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Tendik</p>
                  </a>
              </li>
          </ul>
      </li>
        <li class="nav-item">
          <a href="{{ url('/tugas') }}" class="nav-link ">
            <i class="nav-icon fas fa-tasks"></i>
            <p>Cari Tugas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/tambahtugas') }}" class="nav-link ">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Masukkan Tugas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/verifikasitugas') }}" class="nav-link ">
            <i class="nav-icon fas fa-solid fa-check-double"></i>
            <p>Verifikasi Tugas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/verifikasi') }}" class="nav-link ">
            <i class="nav-icon fas  fa-solid fa-check-double "></i>
            <p>Verifikasi </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/kategori') }}" class="nav-link ">
            <i class="nav-icon fas fa-solid fa-layer-group "></i>
            <p>Kategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/notifikasi') }}" class="nav-link ">
            <i class="nav-icon far fa-regular fa-bell "></i>
            <p>Notifikasi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/pengaturan') }}" class="nav-link ">
            <i class="nav-icon fas fa-cog"></i>
            <p>Pengaturan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/progres') }}" class="nav-link ">
            <i class=" nav-icon fas fa-spinner"></i>
            <p>Progress</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/history') }}" class="nav-link">
            <i class="nav-icon far fa-regular fa-clock "></i>
            <p>History</p>
          </a>
        </li>
      </ul>
    </nav>

    {{-- <div class="d-flex align-items-center">
      <img src="{{ asset('storage/photos/' . auth()->user()->profile_image) }}"  class="avatar rounded-circle me-3" alt="{{auth()->user()->nama}}">
      <div>
          <h6 class="mb-0">{{auth()->user()->username}}</h6>
          <small class="text-muted"><strong>
              {{ auth()->user()->level->level_nama }}
          </strong>
          </small>
      </div>
  </div> --}}


  </div>
  