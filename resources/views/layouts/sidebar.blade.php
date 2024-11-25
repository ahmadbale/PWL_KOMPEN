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

        .active:hover{
          background-color: #F1F3FC!important;
        }
      
        .sidebar {
        position: fixed; /* Sidebar tetap di tempat */
        overflow-y: auto; /* Scroll jika kontennya panjang */
    }   
    </style>
    <!-- Sidebar Menu -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }}">
            <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item has-treeview {{ ($activeMenu == 'level' || $activeMenu == 'prodi') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p class="p1">
                  Manage Pengguna
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level')? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Level Personil</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ url('/prodi') }}" class="nav-link {{ ($activeMenu == 'prodi')? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Prodi Mahasiswa</p>
                  </a>
              </li>
          </ul>
      </li>

        <li class="nav-item has-treeview {{ ($activeMenu == 'mahasiswa' || $activeMenu == 'personilakademik') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p class="p1">
                  Data Pengguna
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
                  <a href="{{ url('/personilakademik') }}" class="nav-link {{ ($activeMenu == 'personilakademik')? 'active' : '' }}">
                    <i class="nav-icon fas "></i>
                      <p>Data Personil</p>
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
          <a href="{{ url('/kompetensi') }}" class="nav-link {{ ($activeMenu == 'kompetensi')? 'active' : '' }}">
            <i class="nav-icon fas fa-tasks"></i>
            <p>Kompetensi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/notifikasi') }}" class="nav-link {{ ($activeMenu == 'notifikasi')? 'active' : '' }}">
            <i class="nav-icon fas fa-bell"></i>
            <p>Notifikasi</p>
          </a>
        </li> 
        <li class="nav-item">
          <a href="{{ url('/jeniskompen') }}" class="nav-link {{ ($activeMenu == 'jeniskompen')? 'active' : '' }}">
            <i class="nav-icon fas fa-filter"></i>
            <p>Jenis Kompen</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/kompen') }}" class="nav-link {{ ($activeMenu == 'kompen')? 'active' : '' }}">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Buat Kompen</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>
  