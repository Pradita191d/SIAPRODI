<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-link">
<<<<<<< Updated upstream
        <img src="{{ asset('dist/img/Logo-PNC.png') }}" alt="AdminLTE Logo" class="brand-image "
=======
        <img src="{{ asset('dist/img/pnc.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
>>>>>>> Stashed changes
            style="opacity: .8">
        <span class="brand-text font-weight-light">SIAPRO</span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="info">
<<<<<<< Updated upstream
                <label class="d-block text-white">Welcome {{ Auth::user()->role ?? 'Admin' }}</label>
=======
                <label class="text-white d-block">Welcome {{ Auth::user()->username ?? 'Alan' }}</label>
>>>>>>> Stashed changes
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
<<<<<<< Updated upstream
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">


=======
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mahasiswa.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>Mahasiswa</p>
                    </a>
                </li>
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream
                            <a href="/mahasiswa" class="nav-link ml-3">
=======
                            <a href="#" class="ml-3 nav-link">
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
                <li class="nav-item d-flex align-items-center">
                    <a href="/undur_diri_do" class="nav-link d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <p class="mb-0">Undur Diri / Do</p>
                    </a>
                </li>
=======
>>>>>>> Stashed changes
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
