<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-link">
        <img src="https://jkb.pnc.ac.id/wp-content/uploads/elementor/thumbs/WhatsApp_Image_2024-12-09_at_16.13.18_7bdfb6f1-removebg-preview-qy8xou2ljv2bccebwb3f6iu5l7o573uoudnhfc4rxu.png"
        alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIAPRO</span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <label class="d-block text-white">Welcome {{ Auth::user()->username ?? '' }}</label>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ipk.index') }}" class="nav-link {{ request()->routeIs('ipk.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Data IPK Mahasiswa</p>
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
                            <a href="#" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub-Menu 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ml-3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub-Menu 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
        
            </ul>
        </nav>
        
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
