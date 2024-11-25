<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ThinkQA</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo-mini.png') }}" />
    <link href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        /* Sidebar Active Menu */
        .sidebar .nav .nav-item.active > .nav-link {
          background-color: #1CB2A2; /* Warna aktif */
          color: #FFFFFF; /* Warna teks */
        }
      
        .sidebar .nav .nav-item > .nav-link:hover {
          background-color: #8B9DAB; /* Warna hover */
          color: #FFFFFF;
        }
      
        /* Card Styles */
        .card {
          border: none;
          border-radius: 8px;
        }
      
        .card-tale .card-body{
          background-color: #8B9DAB; /* Warna isi kartu */
          border-radius: 8px;
        }
      
        /* Card Titles */
        .card .card-body p {
          margin: 0;
        }
      
        .card .card-body p.fs-30 {
          font-size: 30px;
          font-weight: bold;
        }
      
        /* Navbar Background */
        .navbar {
          background-color: #1D3341; /* Warna navbar */
        }
        .navbar .navbar-brand {
          color: #FFFFFF; /* Warna teks navbar */
        }
      </style>
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        @include('partials.navbar')

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('partials.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted">Copyright © 2024. All rights reserved.</span>
                        <span>Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
