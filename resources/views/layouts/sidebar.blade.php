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
                            <a href="/mahasiswa" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="ml-3 nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub-Menu</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <a href="/undur_diri_do" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p class="">Undur Diri / Do</p>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="/tugas_akhir" class="nav-link d-flex align-items-center">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tugas Akhir</p>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="/sertifikat" class="nav-link d-flex align-items-center">
                        <i class="nav-icon fas fa-award"></i>
                        <p>Sertikom Mahasiswa</p>
                    </a>
                </li>

                <!-- Parent Menu -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Menu
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
                </li>
                </li>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
