
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable" data-theme="corporate" data-theme-colors="default">
 
<head>
 
    <meta charset="utf-8" />
    <title>Admin @yield('title') - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" @yield('description')/>
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset("assets/logo.png") }}">
 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
 
    <!-- jsvectormap css -->
    <link href="{{ asset('assets/back') }}/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
 
    <!--Swiper slider css-->
    <link href="{{ asset('assets/back') }}/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
 
    <!-- Layout config Js -->
    <script src="{{ asset('assets/back') }}/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/back') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/back') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/back') }}/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/back') }}/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/back') }}/css/border.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('css')
</head>
 
<body>
 
    <!-- Begin page -->
    <div id="layout-wrapper">
 
        @include('back.template.topbar')
 
        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="../../../../cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                        </div>
                    </div>
 
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- ========== App Menu ========== -->
        @include('back.template.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
 
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
 
            <div class="page-content">
                @yield('content')
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
 
            @include('back.template.footer')
        </div>
        <!-- end main content-->
 
    </div>
    <!-- END layout-wrapper -->
 
    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->
 
    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
 
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Meninggalkan Aplikasi Kalibrasi Digital</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Apakah anda ingin Logout?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
        </div>
    </div>
    </div>
 
 
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/back') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/back') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets/back') }}/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('assets/back') }}/libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('assets/back') }}/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ asset('assets/back') }}/js/plugins.js"></script>
 
    <!-- apexcharts -->
    <script src="{{ asset('assets/back') }}/libs/apexcharts/apexcharts.min.js"></script>
 
    <!-- Vector map-->
    <script src="{{ asset('assets/back') }}/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="{{ asset('assets/back') }}/libs/jsvectormap/maps/world-merc.js"></script>
 
    <!--Swiper slider js-->
    <script src="{{ asset('assets/back') }}/libs/swiper/swiper-bundle.min.js"></script>
 
    <!-- Dashboard init -->
    <script src="{{ asset('assets/back') }}/js/pages/dashboard-ecommerce.init.js"></script>
 
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
 
    <!-- App js -->
    <script src="{{ asset('assets/back') }}/js/app.js"></script>
 
    @stack('script')
</body>
 
 
<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Mar 2024 09:01:47 GMT -->
</html>