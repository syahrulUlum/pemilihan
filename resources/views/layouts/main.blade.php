@include('layouts.header')

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Pemilihan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @auth('web')
                <li class="nav-item {{ request()->is('pemilih/*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pemilih"
                        aria-expanded="true" aria-controls="pemilih">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Pemilih</span>
                    </a>
                    <div id="pemilih" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item {{ request()->is('pemilih/kelas') ? 'active' : '' }}"
                                href="{{ url('/pemilih/kelas') }}">Kelas</a>
                            <a class="collapse-item {{ request()->is('pemilih/jurusan') ? 'active' : '' }}"
                                href="{{ url('/pemilih/jurusan') }}">Jurusan</a>
                            <a class="collapse-item {{ request()->is('pemilih/siswa') ? 'active' : '' }}"
                                href="{{ url('/pemilih/siswa') }}">Siswa</a>
                            <a class="collapse-item {{ request()->is('pemilih/staff') ? 'active' : '' }}"
                                href="{{ url('/pemilih/staff') }}">Staff / Guru</a>

                        </div>
                    </div>
                </li>

                <li class="nav-item {{ request()->is('calon') ? 'active' : (request()->is('calon/*') ? 'active' : '') }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calon"
                        aria-expanded="true" aria-controls="calon">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Data Calon</span>
                    </a>
                    <div id="calon" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item {{ request()->is('calon/kategori') ? 'active' : '' }}"
                                href="{{ url('/calon/kategori') }}">Kategori</a>
                            <a class="collapse-item {{ request()->is('calon') ? 'active' : '' }}"
                                href="{{ url('/calon') }}">Calon</a>
                        </div>
                    </div>
                </li>

                <li
                    class="nav-item {{ request()->is('status') ? 'active' : (request()->is('status/*') ? 'active' : '') }}">
                    <a class="nav-link" href="{{ '/status' }}">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Status Pemilihan</span></a>
                </li>
            @endauth

            @if (Auth::guard('siswa')->user() || Auth::guard('staff')->user())
                <li class="nav-item {{ request()->is('pemilihan') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ '/pemilihan' }}">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Pemilihan</span></a>
                </li>
            @endif

            <li class="nav-item {{ request()->is('hasil') ? 'active' : '' }}">
                <a class="nav-link" href="{{ '/hasil' }}">
                    <i class="fas fa-fw fa-chart-pie"></i>
                    <span>Hasil Pemilihan</span></a>
            </li>

            @auth('web')
                <li class="nav-item {{ request()->is('jadwal') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/jadwal') }}">
                        <i class="fas fa-fw fa-calendar"></i>
                        <span>Jadwal</span></a>
                </li>
            @endauth

            <li class="nav-item {{ request()->is('pengaturan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/pengaturan') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span></a>
            </li>
            <li class="nav-item {{ request()->is('logout') ? 'active' : '' }}">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button style="background: transparent; border: none;" type="submit" class="nav-link"
                        onclick="return confirm('Yakin logout ?')">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span></button>
                </form>

            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Page Wrapper -->
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile.svg">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('layouts.footer')

</body>

</html>
