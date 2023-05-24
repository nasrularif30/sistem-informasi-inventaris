
<header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item  {{ Request::segment(1) === 'dashboard' || Request::segment(1) == '' ? 'active' : null }}">
                  <a class="nav-link" href="/dashboard" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-home"></i>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'penduduk' ? 'active' : null }}">
                  <a class="nav-link" href="/penduduk" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-users"></i>
                    </span>
                    <span class="nav-link-title">
                      Data Penduduk
                    </span>
                  </a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'peminjaman' ? 'active' : null }}">
                  <a class="nav-link" href="./peminjaman" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-box-seam"></i>
                    </span>
                    <span class="nav-link-title">
                      Peminjaman Barang
                    </span>
                  </a>
                </li>
                @if(Auth::user()->leveldata === 'Admin')
                <li class="nav-item {{ Request::segment(1) === 'users' ? 'active' : null }}">
                  <a class="nav-link" href="/users" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-user-plus"></i>
                    </span>
                    <span class="nav-link-title">
                      User Management
                    </span>
                  </a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </header>