<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<div class="sidebar">
    <style>
        p,i{
        color:black;
        }

        ion-icon {
      --ionicon-stroke-width: 50px;
        }

        .active{
          background-color: #F1F3FC!important;
        }
    </style>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/dashboard') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }}">
            <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
            <p>Dashboard</p>
          </a>
        </li>
        {{-- <li class="nav-item has-treeview ">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p class="p1">
                  Manage Pengguna
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
          </li> --}}
          <li class="nav-item has-treeview {{ ($activeMenu == 'mahasiswa') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus-square"></i>
                <p class="p1">
                    Masukkan Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ url('/mahasiswa') }}" class="nav-link {{ ($activeMenu == 'mahasiswa')? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Mahasiswa</p>
                  </a>
              </li>
              <li class="nav-item">
<<<<<<< HEAD
                  <a href="{{ url('/tambahdosen') }}" class="nav-link {{ ($activeMenu == '')? 'active' : '' }}">
=======
                  <a href="{{ url('/prodi') }}" class="nav-link {{ (  'user') ? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Prodi Mahasiswa</p>
                  </a>
              </li>
          </ul>
      </li>

        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p class="p1">
                  Data Pengguna
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
                  <a href="{{ url('/personilakademik') }}" class="nav-link {{ (  'user') ? 'active' : '' }}">
>>>>>>> fd60cadf1c891c84847424257210cf7e3735a76b
                    <i class="nav-icon fas "></i>
                      <p>Data Dosen</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ url('/tambahtendik') }}" class="nav-link {{ ($activeMenu == '')? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Tendik</p>
                  </a>
              </li>
          </ul>
      </li>

      {{-- <li class="nav-item">
        <a href="{{ url('/tugas') }}" class="nav-link ">
          <i class="nav-icon fas fa-check"></i>
          <p>Verifikasi</p>
        </a>
      </li>  --}}
        <li class="nav-item">
<<<<<<< HEAD
          <a href="{{ url('/tugas') }}" class="nav-link {{ ($activeMenu == 'tugas')? 'active' : '' }}">
=======
          <a href="{{ url('/kompetensi') }}" class="nav-link ">
>>>>>>> fd60cadf1c891c84847424257210cf7e3735a76b
            <i class="nav-icon fas fa-tasks"></i>
            <p>Kompetensi</p>
          </a>
        </li>
<<<<<<< HEAD
        <li class="nav-item">
          <a href="{{ url('/tambahtugas') }}" class="nav-link {{ ($activeMenu == 'tambah_tugas')? 'active' : '' }}">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Masukkan Tugas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/verifikasitugas') }}" class="nav-link {{ ($activeMenu == 'verifikasi_tugas')? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-check-double"></i>
            <p>Verifikasi Tugas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/verifikasi') }}" class="nav-link {{ ($activeMenu == 'verifikasi')? 'active' : '' }}">
            <i class="nav-icon fas  fa-solid fa-check-double "></i>
            <p>Verifikasi </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori')? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-layer-group "></i>
            <p>Kategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/notifikasi') }}" class="nav-link {{ ($activeMenu == 'notifikasi')? 'active' : '' }}">
            <i class="nav-icon far fa-regular fa-bell "></i>
=======
        {{-- <li class="nav-item">
          <a href="{{ url('/tugas') }}" class="nav-link ">
            <i class="nav-icon fas fa-bell"></i>
>>>>>>> fd60cadf1c891c84847424257210cf7e3735a76b
            <p>Notifikasi</p>
          </a>s
        </li> --}}
        <li class="nav-item">
          <a href="{{ url('/jeniskompen') }}" class="nav-link ">
            <i class="nav-icon fas fa-filter"></i>
            <p>Jenis Kompen</p>
          </a>
        </li>
        <li class="nav-item">
<<<<<<< HEAD
          <a href="{{ url('/progres') }}" class="nav-link {{ ($activeMenu == 'progres')? 'active' : '' }}">
            <i class=" nav-icon fas fa-spinner"></i>
            <p>Progress</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/history') }}" class="nav-link {{ ($activeMenu == 'history')? 'active' : '' }}">
            <i class="nav-icon far fa-regular fa-clock "></i>
            <p>History</p>
=======
          <a href="{{ url('/kompen') }}" class="nav-link ">
            <i class="nav-icon fas fa-tasks"></i>
            <p>Buat Kompen</p>
>>>>>>> fd60cadf1c891c84847424257210cf7e3735a76b
          </a>
        </li>
      </ul>
    </nav>
  </div>
  