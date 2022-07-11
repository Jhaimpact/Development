<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name') }}-@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('') }}/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/2e8378281c.js" crossorigin="anonymous"></script>
    
    
    <link href="{{ url('') }}/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="{{ url('') }}/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('') }}/assets/plugin/dropify/dist/js/dropify.min.css">

</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled"
            style="text-transform:capitalize" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Jefa</div>
            </a>

            <!-- Divider -->
            {{-- <hr class="sidebar-divider my-0"> --}}

            <!-- Nav Item - Dashboard -->
            @foreach ($render_menu as $item)
                @if ($item->menu_href == '#')
                    @if ($item->child->isNotEmpty())
                        <div class="sidebar-heading">{{ $item->menu_name }}</div>
                        @foreach ($item->child as $child_menu)
                            <x-li-item :component="json_encode($child_menu)" />
                        @endforeach
                        <hr class="sidebar-divider">
                    @endif
                @else
                    <x-li-item :component="json_encode($item)" />
                    <hr class="sidebar-divider">
                @endif
            @endforeach

            <!-- Divider -->

            <!-- Heading -->
            
            {{-- <li class="nav-item">
                <a class="nav-link" href="#" >
                    <i class="fa-solid fa-gauge"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" >
                    <i class="fa-brands fa-intercom"></i>
                    <span>Customers</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" >
                    <i class="fa-solid fa-line-columns"></i>
                    <span>Categories</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" >
                    <i class="fa-solid fa-sitemap"></i>
                    <span>Products</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" >
                    <i class="fa fa-facebook"></i>
                    <span>Dashboard</span></a>
            </li> --}}
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <!-- Main Content -->


            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form method="post" action="/mail"
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control bg-light border-0 small"
                                placeholder="Provide an email" name="email" aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name ?? 'Jaya' }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ url('') }}/assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="{{ route('logout') }}"> --}}
                                <form class="dropdown-item" method="POST" action="{{ url('admin/adminLogout') }}">
                                    @csrf
                                    <i class="fas fa-sign-out-alt mr-2 text-gray-400"></i>
                                    <span onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                        Logout
                                    </span>
                                </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <x-alert-notification />
                @yield('body')
            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Jefa 2021</span>
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
    <div style="position:fixed;background-color:black;color:white;bottom:3px;width:250px;margin:0 auto;left: 50%;
    transform: translateX(-50%);display:none" class="p-4 text-center" id="notification">

    </div>

    <script>
        const base_url  = "{{url('')}}"+'/admin/';
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('') }}/assets/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('') }}/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('') }}/assets/js/sb-admin-2.min.js"></script>

    {{-- data tables --}}

    <script src="{{ url('') }}/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/assets/js/demo/datatables-demo.js"></script>
    <script src="{{ url('') }}/assets/js/swal.js"></script>
    <script src="{{ url('') }}/assets/js/custom.js"></script>
    
    <script src="{{ url('') }}/assets/plugin/dropify/dist/js/dropify.min.js"></script>
    <!-- Page level plugins -->
    {{-- <script src="{{ url('') }}/assets/vendor/chart.js/Chart.min.js"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ url('') }}/assets/js/demo/chart-area-demo.js"></script>
    <script src="{{ url('') }}/assets/js/demo/chart-pie-demo.js"></script> --}}

</body>

</html>
