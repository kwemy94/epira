<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Epira | Dashboard</title>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('template_old/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
        href="{{ asset('template_old/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template_old/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_old/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template_old/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template_old/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template_old/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('template_old/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .error-field {
            border-color: red;
        }
    </style>
    @yield('admin-css')
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        @include('layouts.partials._header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.partials._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-sm-6 col-md-6 mt-2">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            @yield('admin-content')

        </div>


        @include('layouts.partials._footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    {{-- <!-- jQuery --> --}}
    <script src="{{ asset('template_old/plugins/jquery/jquery.min.js') }}"></script>
    {{-- <!-- jQuery UI 1.11.4 --> --}}
    <script src="{{ asset('template_old/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    {{-- <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --> --}}
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{-- <!-- Bootstrap 4 --> --}}
    <script src="{{ asset('template_old/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <!-- ChartJS --> --}}
    <script src="{{ asset('template_old/plugins/chart.js/Chart.min.js') }}"></script>
    {{-- <!-- Sparkline --> --}}
    <script src="{{ asset('template_old/plugins/sparklines/sparkline.js') }}"></script>
    {{-- <!-- JQVMap --> --}}
    <script src="{{ asset('template_old/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('template_old/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    {{-- <!-- jQuery Knob Chart --> --}}
    <script src="{{ asset('template_old/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    {{-- <!-- daterangepicker --> --}}
    <script src="{{ asset('template_old/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template_old/plugins/daterangepicker/daterangepicker.js') }}"></script>
    {{-- <!-- Tempusdominus Bootstrap 4 --> --}}
    <script src="{{ asset('template_old/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    {{-- <!-- Summernote --> --}}
    <script src="{{ asset('template_old/plugins/summernote/summernote-bs4.min.js') }}"></script>
    {{-- <!-- overlayScrollbars --> --}}
    <script src="{{ asset('template_old/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    {{-- <!-- AdminLTE App --> --}}
    <script src="{{ asset('template_old/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('template_old/dist/js/adminlte.min.js') }}"></script>
    @yield('admin-js')
    {{-- <!-- AdminLTE for demo purposes --> --}}
    <script src="{{ asset('template_old/dist/js/demo.js') }}"></script>
    {{-- <!-- AdminLTE dashboard demo (This is only for demo purposes) --> --}}
    <script src="{{ asset('template_old/dist/js/pages/dashboard.js') }}"></script>
</body>

</html>
