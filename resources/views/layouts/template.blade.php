<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ERP || ES-iOS</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('dist/bar/images/logos/favicon.png') }}" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('dist/plugin/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/plugin/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/plugin/datatables/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('dist/plugin/select2/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/plugin/select2/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('dist/plugin/bar/css/styles.min.css') }}" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('dist/images/logo-sjp.jpg') }}">

  <link href="{{ asset('gallery/css/jasny-bootstrap.css') }}" rel="stylesheet">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    
    @include('layouts.sidebar')

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header bg-light" style="height: 50px !important">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <p class="" style="font-size: 12pt;">{!! Auth::user()->nama !!}<i class="ti ti-caret-down ms-2 fs-6"></i></p>
                  {{-- <img src="{{ asset('dist/plugin/bar/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle"> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2" style=" padding-top: 0 !important">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="{!! route('logout') !!}" class="btn btn-outline-primary mx-3 mt-2 d-block"><i class="ti ti-logout"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
    </header>
    <!--  Header End -->

    <div class="container-fluid">
        <div>
            @yield('content')
        </div>
      </div>
    </div>
</div>


  <style>    
    .dropdown-container {
        display: none;
        text-decoration: none;
        /* background-color: #262626; */
        /* padding-left: 15px; */
    }
  </style>


  <!-- Navbar -->
  <script src="{{ asset('dist/plugin/bar/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/bar/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/bar/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('dist/plugin/bar/js/app.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/bar/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/bar/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('dist/plugin/bar/js/dashboard.js') }}"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{ asset('dist/plugin/datatables/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('dist/plugin/datatables/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

  <!-- Select2 -->
  <script src="{{ asset('dist/plugin/select2/select2/js/select2.full.min.js') }}"></script>

  <script src="{{ asset('gallery/js/jasny-bootstrap.js') }}"></script>

  @stack('script')

  <script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
    </script>

    {{-- <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script> --}}

    <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
      })
    </script>
</body>

</html>