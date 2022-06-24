<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
    <div class="sidebar-brand-icon">
      <img src="{{asset('storage/Capture.JPG')}}" width="50px" class="img-fluid">
    </div>
    <div class="sidebar-brand-text mx-3">Shaka Dental Care</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Tables -->
  <li class="nav-item{{ Route::currentRouteName() === 'dokter.home.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('dokter.home.index') }}">
      <i class="fas fa-fw fa-home"></i>
      <span>Home</span></a>
  </li>

  <li class="nav-item{{ Route::currentRouteName() === 'dokter.jadwal.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('dokter.jadwal.index') }}">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Jadwal</span></a>
  </li>
  <li class="nav-item{{ Route::currentRouteName() === 'dokter.pasien.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('dokter.pasien.index') }}">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Pasien</span></a>
  </li>

  <li class="nav-item{{ Route::currentRouteName() === 'dokter.riwayat.index' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('dokter.riwayat.index') }}">
      <i class="fas fa-fw fa-history"></i>
      <span>Riwayat</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
