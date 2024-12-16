<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<div class="sidebar">
    <style>
        p,
        i {
            color: black;
        }

        ion-icon {
            --ionicon-stroke-width: 50px;
        }

        .nav-sidebar .nav-link.active {
        background-color: #F1F3FC!important; 
        }
        .nav-sidebar .nav-link:hover {
        background-color: #F1F3FC!important; 
        }
    </style>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "MHS")
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dahsboardmhs') ? 'active' : '' }}">
                    <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @endif
            @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "ADM")
            <li class="nav-item">
                <a href="{{ url('/dahsboardadm') }}" class="nav-link {{ ($activeMenu == 'dahsboardadm') ? 'active' : '' }}">
                    <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{ ($activeMenu == 'level' || $activeMenu == 'prodi') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p class="p1">
                            Manage Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}">
                                <i class="fas fa-chevron-right nav-icon "></i>
                                <p>Data Level Personil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/prodi') }}" class="nav-link {{ ($activeMenu == 'prodi') ? 'active' : '' }}">
                                <i class="fas fa-chevron-right nav-icon "></i>
                                <p>Data Prodi Mahasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ ($activeMenu == 'mahasiswa' || $activeMenu == 'personilakademik') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p class="p1">
                            Data Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/mahasiswa') }}" class="nav-link {{ ($activeMenu == 'mahasiswa') ? 'active' : '' }}">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/personilakademik') }}" class="nav-link {{ ($activeMenu == 'personilakademik') ? 'active' : '' }}">
                                <i class="fas fa-chevron-right nav-icon "></i>
                                <p>Data Personil</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/kompetensi') }}" class="nav-link {{ ($activeMenu == 'kompetensi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-solid fa-layer-group"></i>
                        <p>Kompetensi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/jeniskompen') }}" class="nav-link {{ ($activeMenu == 'jeniskompen') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-filter"></i>
                        <p>Jenis Kompen</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ ($activeMenu == 'kompen' || $activeMenu == 'tolak_kompen') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Kompen Dosen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/kompen') }}" class="nav-link {{ ($activeMenu == 'kompen') ? 'active' : '' }}">
                              <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Pengajuan Kompen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/tolak_kompen') }}" class="nav-link {{ ($activeMenu == 'tolak_kompen') ? 'active' : '' }}">
                              <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Kompen Ditolak</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ ($activeMenu == 'pengajuan_kompen' || $activeMenu == 'histori_kompen' || $activeMenu== 'histori_selesai') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Kompen Mahasiswa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/pengajuankompen') }}" class="nav-link {{ ($activeMenu == 'pengajuan_kompen') ? 'active' : '' }}">
                              <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Pengajuan Mahasiswa</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/histori_kompen') }}" class="nav-link {{ ($activeMenu == 'histori_kompen') ? 'active' : '' }}">
                                 <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Histori Progres</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/histori_selesai') }}" class="nav-link {{ ($activeMenu == 'histori_selesai') ? 'active' : '' }}">
                                 <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Histori Selesai</p>
                            </a>
                        </li>
                    </ul>       
                </li>
            @endif
            @if (auth()->user()->level->kode_level == 'MHS')
            <li class="nav-item">
                <a href="{{ url('/kompetensi_mahasiswa') }}" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Pilih Kompetensi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/cari_kompen') }}" class="nav-link {{ ($activeMenu == 'cari_tugas') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Cari Tugas</p> 
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/histori_mahasiswa') }}" class="nav-link {{ ($activeMenu == 'histori_mahasiswa') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-history"></i>
                    <p>Histori Kompen</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/histori_mahasiswa_selesai') }}" class="nav-link {{ ($activeMenu == 'histori_mahasiswa_selesai') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-check-square"></i>
                    <p>Kompen Selesai</p>
                </a>
            </li>
            @endif
            @if (auth()->user()->level->kode_level == 'DSN')
            <li class="nav-item">
                <a href="{{ url('/dahsboarddsn') }}" class="nav-link {{ ($activeMenu == 'dahsboarddsn') ? 'active' : '' }}">
                    <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{ ($activeMenu == 'kompen' || $activeMenu == 'tolak_kompen') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Kompen Dosen
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/kompen') }}" class="nav-link {{ ($activeMenu == 'kompen') ? 'active' : '' }}">
                            <i class="fas fa-chevron-right nav-icon"></i>
                            <p>Buat Kompen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/tolak_kompen') }}" class="nav-link {{ ($activeMenu == 'tolak_kompen') ? 'active' : '' }}">
                          <i class="fas fa-chevron-right nav-icon"></i>
                            <p>Kompen Ditolak</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ ($activeMenu == 'pengajuan_kompen' || $activeMenu == 'histori_kompen' || $activeMenu == 'histori_selesai') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Kompen Mahasiswa
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/pengajuankompen') }}" class="nav-link {{ ($activeMenu == 'pengajuan_kompen') ? 'active' : '' }}">
                          <i class="fas fa-chevron-right nav-icon"></i>
                            <p>Pengajuan Mahasiswa</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/histori_kompen') }}" class="nav-link {{ ($activeMenu == 'histori_kompen') ? 'active' : '' }}">
                             <i class="fas fa-chevron-right nav-icon"></i>
                            <p>Histori Progres</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/histori_selesai') }}" class="nav-link {{ ($activeMenu == 'histori_selesai') ? 'active' : '' }}">
                             <i class="fas fa-chevron-right nav-icon"></i>
                            <p>Histori Selesai</p>
                        </a>
                    </li>
                </ul>                
            </li>
            @endif
        </ul>
    </nav>
</div>