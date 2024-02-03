@extends('dashboard.layouts.master')

@section('body')

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      @include('dashboard.partials.sidebar')

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          @include('dashboard.partials.topbar')

          <div class="container-fluid">
            @yield('content')
          </div>

        </div>
        <!-- End of Main Content -->

        @include('dashboard.partials.footer')

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/dashboard/sb-admin-2.js"></script>

    <script>
      (function() {
        'use strict'

        feather.replace({
          'aria-hidden': 'true'
        })
      })()
    </script>

    @yield('custom-script')
  </body>
@endsection
