<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fort Gate Layout</title>

    
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('assets/webfonts/css2.css') }}" rel="stylesheet"> -->

    <style>
    :root {
        --sidebar-width: 260px;
        --sidebar-bg: rgb(26, 67, 84);
        --sidebar-hover: rgb(38, 94, 118);
        --sidebar-active: rgb(35, 88, 110);
        --sidebar-border: #2e6650;
        --blue: #3c9e9e;
        --text-light: #a8c4b8;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: var(--bs-body-bg);
        overflow: hidden;
    }

    .app-layout {
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    .sidebar {
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        color: #fff;
        height: 100vh;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        transition: margin-left 0.25s ease;
    }

    body.sidebar-hidden .sidebar {
        margin-left: calc(var(--sidebar-width) * -1);
    }

    .sidebar-header,
    .sidebar-footer {
        flex-shrink: 0;
    }

    .sidebar-menu {
        flex: 1;
        overflow-y: auto;
        padding: 16px 0;
    }

    .sidebar-menu::-webkit-scrollbar,
    .page-content::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb,
    .page-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.25);
        border-radius: 20px;
    }

    .sidebar-link {
        color: var(--text-light);
        padding: 10px 22px;
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        transition: 0.2s ease;
        border-inline-start: 4px solid transparent;
        font-size: 15px;
    }

    .sidebar-link i {
        width: 20px;
        text-align: center;
        font-size: 15px;
    }

    .sidebar-link:hover {
        background: var(--sidebar-hover);
        color: #fff;
    }

    .sidebar-link.active {
        background: var(--sidebar-active);
        color: #fff;
        border-inline-start-color: var(--blue);
    }

    .sidebar-border {
        border-color: var(--sidebar-border) !important;
    }

    .logo-box {
        width: 42px;
        height: 42px;
        background: var(--blue);
        color: var(--sidebar-bg);
        flex-shrink: 0;
    }

    .avatar {
        width: 38px;
        height: 38px;
        background: var(--blue);
        color: var(--sidebar-bg);
        flex-shrink: 0;
    }

    .sidebar-toggle-btn {
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 10px;
        background: var(--sidebar-hover);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-area {
        flex: 1;
        min-width: 0;
        height: 100vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .topbar {
        height: 48px;
        flex-shrink: 0;
        background: transparent;
        border-bottom: 0;
        display: flex;
        align-items: center;
        padding: 10px 16px 0;
    }

    .sidebar-arrow-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .page-content {
        flex: 1;
        overflow-y: auto;
        padding: 12px 24px 24px;
    }

    .stat-card {
        border: 1px solid var(--bs-border-color);
        border-radius: 16px;
        padding: 20px;
        background: var(--bs-body-bg);
    }

    .desktop-open-sidebar-btn {
        display: none;
    }

    body.sidebar-hidden .desktop-open-sidebar-btn {
        display: inline-flex;
    }

    .theme-btn {
        border: 1px solid var(--bs-border-color);
        background: transparent;
        color: var(--bs-body-color);
        border-radius: 10px;
        height: 38px;
        padding: 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @media (max-width: 991px) {
        body {
        overflow: auto;
        }

        .app-layout {
        height: auto;
        display: block;
        overflow: visible;
        }

        .sidebar {
        position: fixed;
        top: 0;
        left: -100%;
        margin-left: 0 !important;
        width: 280px;
        z-index: 1050;
        transition: left 0.3s ease;
        }

        .sidebar.show {
        left: 0;
        }

        body.sidebar-hidden .sidebar {
        left: -100%;
        }

        .main-area {
        height: 100vh;
        }

        .page-content {
        padding: 18px;
        }

        .desktop-open-sidebar-btn {
        display: none !important;
        }

        .sidebar-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 1040;
        display: none;
        }

        .sidebar-backdrop.show {
        display: block;
        }
    }
    </style>
    @yield('styles')
</head>

<body>

  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="closeMobileSidebar()"></div>

  <div class="app-layout">

    <aside class="sidebar" id="sidebar">

      <div class="sidebar-header border-bottom sidebar-border d-flex align-items-center justify-content-between p-3">
        <a href="#" class="d-flex align-items-center gap-3 text-decoration-none">
          <div class="logo-box rounded-3 d-flex align-items-center justify-content-center fs-5">
            <i class="bi bi-truck"></i>
          </div>

          <div>
            <div class="fw-bold text-white">FORT GATE </div>
            <small style="color: var(--blue);">Shipment Management</small>
          </div>
        </a>

        <button class="sidebar-toggle-btn d-none d-lg-flex" onclick="hideDesktopSidebar()">
          <i class="bi bi-arrow-left"></i>
        </button>
      </div>

      <nav class="sidebar-menu">

        <a href="#" class="sidebar-link active">
          <i class="bi bi-house"></i>
          <span>Dashboard</span>
        </a>

        <a href="#" class="sidebar-link">
          <i class="bi bi-box-seam"></i>
          <span>Total Shipments</span>
        </a>

        <a href="#" class="sidebar-link">
          <i class="bi bi-people"></i>
          <span>Customers</span>
        </a>

        <a href="#" class="sidebar-link">
          <i class="bi bi-truck"></i>
          <span>Transport</span>
        </a>

        <a href="#" class="sidebar-link">
          <i class="bi bi-chat-dots"></i>
          <span>Chats</span>
        </a>

        <a href="#" class="sidebar-link">
          <i class="bi bi-building"></i>
          <span>Shipping Companies</span>
        </a>

        <hr class="sidebar-border mx-3">

        <a href="#" class="sidebar-link">
          <i class="bi bi-wallet"></i>
          <span>Expenses</span>
        </a>

        <a href="#" class="sidebar-link">
          <i class="bi bi-graph-up-arrow"></i>
          <span>Reports</span>
        </a>

        <a href="#" class="sidebar-link">
          <i class="bi bi-whatsapp"></i>
          <span>WhatsApp</span>
        </a>

        @can('viewAny', App\Models\User::class)
          <a href="{{ route('users.show') }}" class="sidebar-link">
            <i class="bi bi-people"></i>
            <span>Users</span>
          </a>
        @endcan

        <a href="#" class="sidebar-link">
          <i class="bi bi-gear"></i>
          <span>Settings</span>
        </a>

      </nav>

      <div class="sidebar-footer p-3 border-top sidebar-border">
        
        <a href="{{ route('profile.show') }}"
          class="d-flex align-items-center gap-2 mb-3 text-decoration-none">

            <div class="avatar rounded-circle d-flex align-items-center justify-content-center fw-bold">
                {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div>
                <div class="fw-bold small text-white">
                    {{ auth()->user()->name ?? '' }}
                </div>

                <small style="color: var(--text-light);">
                    {{ auth()->user()->role->name ?? '' }}
                </small>
            </div>
        </a>

        <button class="btn btn-sm w-100 text-start sidebar-link border-0 bg-transparent mb-2 px-0" onclick="toggleTheme()">
            <i class="bi bi-circle-half"></i>
            <span>Theme</span>
        </button>

        
        @if (auth()->check())
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-sm w-100 text-start text-danger">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        @endif

      </div>

    </aside>

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

  @include('components.alert-toast')

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
</body>

</html>