<!DOCTYPE html>
<html lang="en">

@include('backend.layouts.head')

<body id="page-top">
<div class="page-loader-wrapper">
<div class="loader">
<div class="n-t-30"><img src="{{asset('backend/assets/images/loader.gif')}}"></div>
</div>
</div>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('backend.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('backend.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('backend.layouts.footer')

</body>

</html>
