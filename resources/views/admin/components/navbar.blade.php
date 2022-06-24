<nav class="navbar navbar-expand navbar-light bg-white topbar sticky-top mb-4 shadow">
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <small class="ms-auto my-auto d-sm-block d-md-none d-lg-none d-xl-none text-center p-2">
    @yield('title')
  </small>

  <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown no-arrow me-2">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="me-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
        <i class="fas fa-user text-black-50"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
          Profile
        </a>

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
          <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

  <form id="formLogout" class="d-none" action="{{ route('logout') }}" method="POST">
    @csrf
  </form>
</nav>
