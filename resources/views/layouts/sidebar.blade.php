<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-link">

        <img src="{{ asset('dist/img/Logo-PNC.png') }}" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">

        <span class="brand-text font-weight-light">SIAPRO</span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="info">

                <label class="d-block text-white">Welcome {{ Auth::user()->role ?? 'Admin' }}</label>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Parent Menu -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <!-- Submenu -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/olahdata" class="nav-link ml-3">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Data Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/mahasiswa" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dosen" class="nav-link ml-3">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Data Dosen</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <a href="/undur_diri_do" class="nav-link d-flex align-items-center">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p class="">Undur Diri / Do</p>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="/tugas_akhir" class="nav-link d-flex align-items-center">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tugas Akhir</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Sertifikat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <!-- Submenu -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sertifikat_mahasiswa" class="nav-link d-flex align-items-center">
                        <i class="nav-icon fas fa-award"></i>
                        <p>Sertifikat Kompetensi Mahasiswa</p>
                    </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sertikomcrud" class="nav-link">
                        <i class="nav-icon fas fa-award"></i>
                        <p>Sertifikat Kompetensi Dosen</p>
                    </a>
                        </li>
                        
                    </ul>
                </li>
                <!-- Parent Menu -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Magang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <!-- Submenu -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('magang.mahasiswa_magang.show') }}" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Mahasiswa Magang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('magang.index') }}" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tempat Magang</p>
                            </a>
                        </li>
                    </ul>
                    <!-- Parent Menu -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            RKA dan TOR
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <!-- Submenu -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('rka.index') }}" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan RKA</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tor.index') }}" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan TOR</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="{{ route('ipk.index') }}"
                        class="nav-link {{ request()->routeIs('ipk.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Data IPK Mahasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mou" class="nav-link">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>MOU</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penelitian-dosen.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-microscope"></i>
                        <p>Data Penelitian Dosen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mbkm" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Data MBKM</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/data-pemanggilan" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Pemanggilan Orang Tua</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kegiatan_dosen" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Data Kegiatan Dosen Di luar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/prestasi" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Data Prestasi Mahasiswa</p>
                    </a>
                </li>
                <!-- Wisuda Menu -->
                <li class="nav-item">
                    <a href="/wissuda" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Data Wisuda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/maspan" class="nav-link">
                        <i class="nav-icon fas fa-hourglass-half"></i>
                        <p>Data Mahasiswa Semester Perpanjangan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pkm" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Data PKM</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/yudisium" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Data Yudisium</p>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
