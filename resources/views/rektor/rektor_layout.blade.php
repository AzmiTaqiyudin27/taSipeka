<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPEKA</title>
<link rel="shortcut icon" href="{{ asset('images/logounsud.png') }}" type="image/x-icon">



    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">



    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">

</head>

<body>
    <!-- <script src="assets/static/js/initTheme.js"></script> -->

    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html">
                                <h3>SIPEKA</h3>
                            </a>
                        </div>

                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        {{-- <li class="sidebar-item">
                            <a href="{{ route('dashboard-pimpinan') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li> --}}

                        {{-- <li class="sidebar-item has-sub ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-book"></i>
                                <span>Penindakan Audit</span>
                            </a>

                            <ul class="submenu">
                                <li class="submenu-item  ">
                                    <a href="{{ route('pimpinan-auditinsidental') }}"
                                        class="submenu-link">Insidental</a>
                                </li>

                                <li class="submenu-item  ">
                                    <a href="{{ route('pelaporan-rutin.index') }}" class="submenu-link">Rutin</a>
                                </li>
                            </ul>
                        </li> --}}
                        <!-- <li class="sidebar-item has-sub ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-book"></i>
                                <span>Pelaporan Audit</span>
                            </a>

                            <ul class="submenu">


                                <li class="submenu-item  ">
                                    <a href="{{ route('pimpinan-pelaporanauditrutin') }}"
                                        class="submenu-link">Rutin</a>
                                </li>

                                <li class="submenu-item  ">
                                    <a href="{{ route('pimpinan-pelaporanauditinsidental') }}"
                                        class="submenu-link">Insidental</a>
                                </li>
                            </ul>
                        </li> -->

                        <li class="sidebar-item has-sub ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-book"></i>
                                <span>Hasil Audit</span>
                            </a>

                            <ul class="submenu">


                                <li class="submenu-item  ">
                                    <a href="{{ route('hasil-rutin.hasil') }}" class="submenu-link">Rutin</a>
                                </li>

                                <li class="submenu-item  ">
                                    <a href="{{ route('pimpinan-hasilauditinsidental') }}"
                                        class="submenu-link">Insidental</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{ route('rektor.profile') }}" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>Profile</span>
                            </a>
                        </li>

                        <form id="logoutForm" action="{{ route('logout.post') }}" method="post">
                            @csrf
                            <!-- Tambahkan atribut onclick untuk mengirimkan formulir saat diklik -->
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link"
                                    onclick="document.getElementById('logoutForm').submit(); return false;">
                                    <i class="bi bi-box-arrow-left"></i>
                                    <span>Keluar</span>
                                </a>
                            </li>
                        </form>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <center>
                        <p>2024 © All rights reserved by Lembaga Pengembangan Teknologi dan Sistem Informasi</p>
                    </center>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>



    <!-- Need: Apexcharts -->
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>




    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
</body>

</html>
