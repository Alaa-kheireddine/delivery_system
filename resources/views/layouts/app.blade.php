<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fort Gate Layout</title>

    
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-icons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/content.css') }}">
    
    @yield('styles')
</head>

<body>

  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="closeMobileSidebar()"></div>

  <div class="app-layout">

    @include('layouts.partials.sidebar')

    <main class="main-area">

      <header class="topbar">
            <button class="btn btn-light border shadow-sm sidebar-arrow-btn d-lg-none" onclick="openMobileSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <button class="btn btn-light border shadow-sm sidebar-arrow-btn desktop-open-sidebar-btn" onclick="showDesktopSidebar()">
                <i class="bi bi-arrow-right"></i>
            </button>
        </header>

      <section class="page-content">

        @yield('content')

      </section>

    </main>

  </div>

  @include('layouts.partials.alert-toast')


  <!-- Scripts -->

  <script>
    const html = document.documentElement;
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');

    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-bs-theme', savedTheme);

    function toggleTheme() {
      const currentTheme = html.getAttribute('data-bs-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

      html.setAttribute('data-bs-theme', newTheme);
      localStorage.setItem('theme', newTheme);
    }

    function hideDesktopSidebar() {
      document.body.classList.add('sidebar-hidden');
    }

    function showDesktopSidebar() {
      document.body.classList.remove('sidebar-hidden');
    }

    function openMobileSidebar() {
      sidebar.classList.add('show');
      backdrop.classList.add('show');
    }

    function closeMobileSidebar() {
      sidebar.classList.remove('show');
      backdrop.classList.remove('show');
    }
  </script>
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

  @yield('scripts')
  
</body>

</html>