<!DOCTYPE html>
<html lang="id">

<head>
  @yield('header')
  @yield('top-assets')
  @yield('top-assets-page')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <div style="min-height: 92vh;"></div>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column bg-white overflow-hidden">

      @yield('main-content')

      <!-- Footer -->
      <footer class="sticky-footer bg-white shadow-lg py-3">
        <div class="container my-auto">
          <div class="text-center my-auto">
            <small>&copy; B03 SI Warung Makan 2021
            </small>
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

  @yield('bottom-assets')
  @yield('bottom-assets-page')
</body>

</html>
