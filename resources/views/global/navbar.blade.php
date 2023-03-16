
<header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item  {{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                  <a class="nav-link" href="/dashboard" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-home"></i>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'warga' ? 'active' : null }}">
                  <a class="nav-link" href="./" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-users"></i>
                    </span>
                    <span class="nav-link-title">
                      Data Penduduk
                    </span>
                  </a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'inventaris' ? 'active' : null }}">
                  <a class="nav-link" href="./" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-box-seam"></i>
                    </span>
                    <span class="nav-link-title">
                      Peminjaman Barang
                    </span>
                  </a>
                </li>
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
              </ul>
              <!-- <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                <form action="./" method="get" autocomplete="off" novalidate>
                  <div class="input-icon">
                    <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                    </span>
                    <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
                  </div>
                </form>
              </div> -->
            </div>
          </div>
        </div>
      </header>