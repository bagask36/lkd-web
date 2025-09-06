<div class="app-menu navbar-menu bg-white">
    <div class="navbar-brand-box bg-white">
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset("assets/logo.png") }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset("assets/logo.png") }}" alt="" height="66">
            </span>
        </a>
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset("assets/logo.png") }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset("assets/logo.png") }}" alt="" height="66">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded bg-white">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">ade</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('laporan.search_only') }}">
                        <i class="ri-search-line"></i> <span data-key="t-search">Cari Laporan</span>
                    </a>
                </li>
            
                <li class="menu-title"><span>alat</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('kalibrasi.index') }}">
                        <i class="ri-folder-line"></i> <span>kalibrasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('maintenance.index') }}">
                        <i class="ri-folder-line"></i> <span>maintanance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('instalasi.index') }}">
                        <i class="ri-folder-line"></i> <span>instalasi</span>
                    </a>
                </li>

                <li class="menu-title"><span>laporan</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('laporan.index') }}">
                        <i class="ri-notification-3-line"></i> <span>laporan kalibrasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('laporan-maintenance.index') }}">
                        <i class="ri-notification-3-line"></i> <span>laporan maintenance</span>
                    </a>
                </li>

                <li class="menu-title"><span>Layanan & Klinik</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-service-line"></i> <span>Layanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-hospital-line"></i> <span>Klinik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-chat-quote-line"></i> <span>Testimoni</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
    <div class="sidebar-background"></div>
</div>