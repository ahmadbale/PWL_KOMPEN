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
    </style>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "MHS")
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link ">
                    <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @endif
            @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "ADM")
            <li class="nav-item">
                <a href="{{ url('/dashboard-admin') }}" class="nav-link ">
                    <i class="nav-icon fas"> <ion-icon name="grid-outline"></ion-icon></i>
                    <p>Dashboard</p>
                </a>
            </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-plus-square"></i>
                        <p class="p1">
                            Manage Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/level') }}" class="nav-link {{ 'level' ? 'active' : '' }}">
                                <i class="nav-icon fas "></i>
                                <p>Data Level Personil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/prodi') }}" class="nav-link {{ 'user' ? 'active' : '' }}">
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
                            <a href="{{ url('/mahasiswa') }}" class="nav-link {{ 'level' ? 'active' : '' }}">
                                <i class="nav-icon fas "></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/personilakademik') }}" class="nav-link {{ 'user' ? 'active' : '' }}">
                                <i class="nav-icon fas "></i>
                                <p>Data Personil</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/kompetensi') }}" class="nav-link ">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Kompetensi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/jeniskompen') }}" class="nav-link ">
                        <i class="nav-icon fas fa-filter"></i>
                        <p>Jenis Kompen</p>
                    </a>
                </li>
            @endif
            @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "MHS")
            <li class="nav-item">
                <a href="{{ url('/cari_kompen') }}" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Cari Tugas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/kompenhistori') }}" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Histori Kompen</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/tolakkompen') }}" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Kompen Ditolak</p>
                </a>
            </li>

            @endif
            @if (auth()->user() && auth()->user()->level && auth()->user()->level->kode_level == "DSN")
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p class="p1">
                            Kompen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/kompen') }}" class="nav-link {{ 'kompen' ? 'active' : '' }}">
                                <i class="nav-icon fas "></i>
                                <p>Buat Kompen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/pengajuankompen') }}" class="nav-link {{ 'user' ? 'active' : '' }}">
                                <i class="nav-icon fas "></i>
                                <p>Pengajuan Kompen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/tolak_kompen') }}"
                                class="nav-link {{ 'user' ? 'active' : '' }}">
                                <i class="nav-icon fas "></i>
                                <p>Tolak Kompen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/personilakademik') }}"
                                class="nav-link {{ 'user' ? 'active' : '' }}">
                                <i class="nav-icon fas "></i>
                                <p>Progres Kompen</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
</div>