      <!-- Preloader --> {{-- <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__shake" src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
              height="60" width="60">
      </div> --}}

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
          </ul>

          <!-- Right navbar links -->
          <ul class="ml-auto navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <div class="d-flex align-items-center">
                          <div class="ms-3"><i class="mr-2 fas fa-sign-out-alt"></i></i>Keluar</div>
                      </div>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </a>
              </li>
          </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-success elevation-4">
          <!-- Brand Logo -->
          <a href="{{ route('dashboard') }}" class="brand-link">
              {{-- <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                  class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
              <img src="{{ asset('pemda.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                  style="opacity: .8">
              <span class="brand-text font-weight-light">PRIMADONA DESA</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="pb-3 mt-3 mb-3 user-panel d-flex">
                  <div class="image">
                      <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                          alt="User Image">
                  </div>
                  <div class="info">
                      <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                  </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false">
                      <li class="nav-item">
                          <a href="{{ route('dashboard') }}"
                              class="nav-link  {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}{{ Request::segment(1) == '' ? 'active' : '' }}">
                              <i class="nav-icon fas fa-home"></i>
                              <p>
                                  Beranda
                              </p>
                          </a>
                      <li class="nav-item">
                          <a href="{{ route('admin.pengajuan') }}"
                              class="nav-link
                              {{ Request::segment(1) == 'pengajuan' ? 'active' : '' }}
                              {{ Request::segment(2) == 'pengajuan' ? 'active' : '' }}
                              {{ Request::segment(1) == 'detail-pengajuan' ? 'active' : '' }}
                              ">
                              <i class="nav-icon fas fa-book-open"></i>
                              <p>
                                  Pengajuan
                              </p>
                          </a>
                      </li>

                      @role(['dinsos'])
                          <li
                              class="nav-item
                                {{ Request::segment(2) == 'jenis-pengajuan' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'pengumuman' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'user-index' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'user' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'background' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'region' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'region-index' ? 'menu-is-opening menu-open' : '' }}
                              ">
                              <a href="#"
                                  class="nav-link
                                  {{ Request::segment(2) == 'jenis-pengajuan' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'pengumuman' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'user-index' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'user' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'background' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'region' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'region-index' ? 'active' : '' }}
                                  ">
                                  <i class="nav-icon fas fa-database"></i>
                                  <p>
                                      Master
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('admin.user-index') }}"
                                          class="nav-link
                                      {{ Request::segment(2) == 'user-index' ? 'active' : '' }}
                                      {{ Request::segment(2) == 'user' ? 'active' : '' }}
                                      ">
                                          @if (Request::segment(2) == 'user')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @elseif(Request::segment(2) == 'user-index')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>User</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('admin.jenis-pengajuan') }}"
                                          class="nav-link {{ Request::segment(2) == 'jenis-pengajuan' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'jenis-pengajuan')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Jenis Pengajuan</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('admin.pengumuman') }}"
                                          class="nav-link {{ Request::segment(2) == 'pengumuman' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'pengumuman')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Pengumuman</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('admin.background') }}"
                                          class="nav-link {{ Request::segment(2) == 'background' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'background')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Background</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('admin.region-index') }}"
                                          class="nav-link
                                            {{ Request::segment(2) == 'region-index' ? 'active' : '' }}
                                            {{ Request::segment(2) == 'region' ? 'active' : '' }}
                                            ">
                                          @if (Request::segment(2) == 'region')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @elseif(Request::segment(2) == 'region-index')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Region</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          {{-- <li
                              class="nav-item
                                {{ Request::segment(2) == 'list-role' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'role' ? 'menu-is-opening menu-open' : '' }}
                                {{ Request::segment(2) == 'permission' ? 'menu-is-opening menu-open' : '' }}
                              ">
                              <a href="#"
                                  class="nav-link
                                  {{ Request::segment(2) == 'list-role' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'role' ? 'active' : '' }}
                                  {{ Request::segment(2) == 'permission' ? 'active' : '' }}
                                  ">
                                  <i class="nav-icon fa-solid fa-user"></i>
                                  <p>
                                      Setting User
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('admin.list-role') }}"
                                          class="nav-link {{ Request::segment(2) == 'list-role' ? 'active' : '' }} {{ Request::segment(2) == 'role' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'list-role')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @elseif (Request::segment(2) == 'role')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Role</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('admin.permission') }}"
                                          class="nav-link {{ Request::segment(2) == 'permission' ? 'active' : '' }}">
                                          @if (Request::segment(2) == 'permission')
                                              <i class="ml-2 far fa-dot-circle nav-icon"></i>
                                          @else
                                              <i class="ml-2 far fa-circle nav-icon"></i>
                                          @endif
                                          <p>Permission</p>
                                      </a>
                                  </li>
                              </ul>
                          </li> --}}
                      @endrole
                      @role(['desa', 'kecamatan'])
                          <li class="nav-item">
                              <a href="{{ route('profile') }}"
                                  class="nav-link
                            {{ Request::segment(1) == 'profile' ? 'active' : '' }}
                              ">
                                  <i class="nav-icon fas fa-user-cog"></i>
                                  <p>
                                      Profile
                                  </p>
                              </a>
                          </li>
                      @endrole
                  </ul>

              </nav>
              <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>
