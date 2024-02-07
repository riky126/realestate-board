<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container-fluid">
    
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0 logo" href="#">
        <img
          src="{{ asset('images/logo.svg') }}"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
      @if (Auth::check())
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}" 
                aria-active href="{{ URL::to('dashboard')}}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('contributions*') ? 'active' : '' }}"
               href="{{ URL::to('contributions')}}">Contributions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('proprietors*') ? 'active' : '' }}" 
                href="{{ URL::to('proprietors')}}">Proprietors</a>
          </li>
        </ul>
      @endif
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center profile-block">
      <!-- Icon -->
      @auth
        <a class="text-reset me-3 user-greeting" href="#">
          <span>Hi {{  explode(' ',Auth::user()->name)[0] }}!</span>
        </a>
      @endauth

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