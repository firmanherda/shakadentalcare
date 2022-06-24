<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('pasien.home.index') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('storage/Capture.JPG') }}" width="5  0px" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3">Shaka Dental Care</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Tables -->
    <li class="nav-item{{ Route::currentRouteName() === 'pasien.home.index' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pasien.home.index') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>
    <li class="nav-item{{ Route::currentRouteName() === 'pasien.booking.index' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pasien.booking.index') }}">
            <i class="fas fa-fw fa-address-book"></i>
            <span>Booking</span></a>
    </li>

    <li class="nav-item{{ Route::currentRouteName() === 'pasien.dokter.index' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pasien.dokter.index') }}">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Dokter</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
