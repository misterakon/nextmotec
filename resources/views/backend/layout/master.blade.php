<!doctype html>

<html
  lang="en"
  class=" layout-navbar-fixed layout-menu-fixed layout-compact "
  dir="ltr"
  data-skin="default"
  data-bs-theme="light"
  data-assets-path="{{ asset('public/backend/assets/') }}"
  data-template="vertical-menu-template">

  {{-- head --}}
  @include('backend.layout.head')

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
      <div class="layout-container">
        
        <!-- Menu -->
            @include('backend.layout.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->
          @include('backend.layout.navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">

            <!-- Content -->
            <main>
                @yield('main-content')
            </main>
            <!-- / Content -->

            <!-- Footer -->
            @include('backend.layout.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js  -->

    {{-- script --}}
    @include('backend.layout.script_js')

  </body>
</html>
