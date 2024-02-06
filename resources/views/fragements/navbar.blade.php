<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container-fluid">
    
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0 logo" href="#">
        <img
          src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" 
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
      @if (Auth::check())
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-active href="#">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Projects</a>
          </li>
        </ul>
      @endif
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center profile-block">
      <!-- Icon -->
      <a class="text-reset me-3 user-greeting" href="#">
        <span>Hi {{ $user->first_name }}!</span>
      </a>

      @if (!Auth::guest())
      <!-- Avatar -->
      <div class="dropdown">
        <a
          data-mdb-dropdown-init
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-bs-toggle="dropdown" 
          aria-expanded="false"
        >
          <img
            src="{{ URL::asset('images/profile-icon.svg') }}"
            class="rounded-circle avatar-icon"
            height="25"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
          <li>
            <a class="dropdown-item" href="/profile">My profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="/account">Account</a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ URL::to('logout')}}">Logout</a>
          </li>
        </ul>
      </div>
      @endif
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->