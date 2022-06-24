<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
    <div class="sidebar-brand-icon">
      {{-- <i class="fas fa-laugh-wink"></i> --}}
      <img src="{{asset('storage/Capture.JPG')}}" width="50px" class="img-fluid">
    </div>
    <div class="sidebar-brand-text mx-3">Shaka Dental Care</div>

  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Tables -->
  <li class="nav-item{{ Route::currentRouteName() === 'admin.home' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('admin.home') }}">
      <i class="fas fa-fw fa-home"></i>
      <span>Home</span></a>
  </li>

  <li class="nav-item{{ Route::currentRouteName() === 'admin.dokter.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dokter.index') }}">
      <i class="fas fa-fw fa-user-md"></i>
      <span>Dokter</span></a>
  </li>
  <li class="nav-item{{ Route::currentRouteName() === 'admin.service.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('admin.service.index') }}">
      <i class="fas fa-fw fa-user-md"></i>
      <span>Service</span></a>
  </li>

  <li class="nav-item{{ Route::currentRouteName() === 'admin.pasien.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('admin.pasien.index') }}">
      <i class="fas fa-fw fa-user"></i>
      <span>Pasien</span></a>
  </li>

  <li class="nav-item{{ Route::currentRouteName() === 'admin.jadwal.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('admin.jadwal.index') }}">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Jadwal</span></a>
  </li>

  <li class="nav-item{{ Route::currentRouteName() === 'admin.booking.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('admin.booking.index') }}">
      <i class="fas fa-fw fa-address-book"></i>
      <span>Booking</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
