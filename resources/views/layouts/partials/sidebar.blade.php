    <aside class="sidebar" id="sidebar">

    {{-- Header --}}
    <div class="sidebar-header border-bottom sidebar-border d-flex align-items-center justify-content-between p-3">
        <a href="{{ route('dashboard.index') }}" class="d-flex align-items-center gap-3 text-decoration-none">
            <div class="logo-box rounded-3 d-flex align-items-center justify-content-center fs-5">
                <i class="bi bi-truck"></i>
            </div>

            <div>
                <div class="fw-bold text-white">FORT GATE</div>
                <small style="color: var(--blue);">Shipment Management</small>
            </div>
        </a>

        <button class="sidebar-toggle-btn d-none d-lg-flex" onclick="hideDesktopSidebar()">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>

    {{-- Menu --}}
    <nav class="sidebar-menu">

    <!-- class active -->
    <a href="{{ route('dashboard.index') }}" class="sidebar-link "> 
        <i class="bi bi-house"></i>
        <span>Dashboard</span>
    </a>

    {{-- Shipments Dropdown --}}
    <div class="sidebar-dropdown">
        <button class="sidebar-link sidebar-dropdown-btn" type="button" onclick="toggleSidebarDropdown(this)">
            <i class="bi bi-box-seam"></i>
            <span>Shipments</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div class="sidebar-submenu">
            {{-- route('shipments.index') --}}
            <a href="#" class="sidebar-sublink">All Shipments</a>

            {{-- route('shipments.pending') --}}
            <a href="#" class="sidebar-sublink">Pending Shipments</a>

            {{-- route('shipments.active') --}}
            <a href="#" class="sidebar-sublink">Active Shipments</a>

            {{-- route('shipments.delivered') --}}
            <a href="#" class="sidebar-sublink">Delivered Shipments</a>

            {{-- route('shipments.cancelled') --}}
            <a href="#" class="sidebar-sublink">Cancelled Shipments</a>

            {{-- route('shipments.trashed') --}}
            <a href="#" class="sidebar-sublink">Deleted Shipments</a>
        </div>
    </div>

    {{-- Missions Dropdown --}}
    <div class="sidebar-dropdown">
        <button class="sidebar-link sidebar-dropdown-btn" type="button" onclick="toggleSidebarDropdown(this)">
            <i class="bi bi-briefcase"></i>
            <span>Work</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div class="sidebar-submenu">
            {{-- route('missions.index') --}}
            <a href="#" class="sidebar-sublink">My Missions</a>

            {{-- route('shipments.active') --}}
            <a href="#" class="sidebar-sublink">My Active Shipments</a>
        </div>
    </div>

    {{-- Management Dropdown --}}
    @if (auth()->user()->role->name === 'admin'
        || auth()->user()->role->name ==='manager')
        <div class="sidebar-dropdown">
            <button class="sidebar-link sidebar-dropdown-btn" type="button" onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-diagram-3"></i>
                <span>Management</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </button>

            <div class="sidebar-submenu">

                <a href="{{ route('branches.index') }}" class="sidebar-sublink">Branches</a>

                {{-- route('shippers.index') --}}
                <a href="#" class="sidebar-sublink">Shippers</a>

                {{-- route('customers.index') --}}
                <a href="#" class="sidebar-sublink">Customers</a>

                {{-- route('shipment-assignments.index') --}}
                <a href="#" class="sidebar-sublink">Assignments</a>
            </div>
        </div>
    @endif

    {{-- Finance Dropdown --}}
    <div class="sidebar-dropdown">
        <button class="sidebar-link sidebar-dropdown-btn" type="button" onclick="toggleSidebarDropdown(this)">
            <i class="bi bi-wallet"></i>
            <span>Finance</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div class="sidebar-submenu">
            {{-- route('expenses.index') --}}
            <a href="#" class="sidebar-sublink">Expenses</a>

            {{-- route('payments.index') --}}
            <a href="#" class="sidebar-sublink">Payments</a>

            {{-- route('cod.index') --}}
            <a href="#" class="sidebar-sublink">Cash Collection</a>
        </div>
    </div>

    {{-- Reports Dropdown --}}
    <div class="sidebar-dropdown">
        <button class="sidebar-link sidebar-dropdown-btn" type="button" onclick="toggleSidebarDropdown(this)">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Reports</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div class="sidebar-submenu">
            {{-- route('reports.index') --}}
            <a href="#" class="sidebar-sublink">Reports Overview</a>

            {{-- route('reports.shipments') --}}
            <a href="#" class="sidebar-sublink">Shipment Reports</a>

            {{-- route('reports.finance') --}}
            <a href="#" class="sidebar-sublink">Finance Reports</a>
        </div>
    </div>

    {{-- System Dropdown --}}
    <div class="sidebar-dropdown">
        <button class="sidebar-link sidebar-dropdown-btn" type="button" onclick="toggleSidebarDropdown(this)">
            <i class="bi bi-gear"></i>
            <span>System</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div class="sidebar-submenu">
            {{-- route('recent-actions.index') --}}
            <a href="#" class="sidebar-sublink">Recent Actions</a>

            {{-- route('notifications.index') --}}
            <a href="#" class="sidebar-sublink">Notifications</a>

            {{-- route('whatsapp.index') --}}
            <a href="#" class="sidebar-sublink">WhatsApp</a>

            {{-- route('chats.index') --}}
            <a href="#" class="sidebar-sublink">Chats</a>
        </div>
    </div>

    {{-- Admin Dropdown --}}
    <div class="sidebar-dropdown">
        <button class="sidebar-link sidebar-dropdown-btn" type="button" onclick="toggleSidebarDropdown(this)">
            <i class="bi bi-person-gear"></i>
            <span>Admin</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </button>

        <div class="sidebar-submenu">
            {{-- route('users.index') --}}
            <a href="#" class="sidebar-sublink">Users</a>

            {{-- route('roles.index') --}}
            <a href="#" class="sidebar-sublink">Roles</a>

            {{-- route('permissions.index') --}}
            <a href="#" class="sidebar-sublink">Permissions</a>

            {{-- route('settings.index') --}}
            <a href="#" class="sidebar-sublink">Settings</a>
        </div>
    </div>

</nav>

    {{-- Footer --}}
    <div class="sidebar-footer p-3 border-top sidebar-border">

        <a href="{{ route('profile.show') }}"
           class="d-flex align-items-center gap-2 mb-3 text-decoration-none">

            <div class="avatar rounded-circle d-flex align-items-center justify-content-center fw-bold">
                {{ mb_strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}
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

        <button class="btn btn-sm w-100 text-start sidebar-link border-0 bg-transparent mb-2 px-0"
                onclick="toggleTheme()">
            <i class="bi bi-circle-half"></i>
            <span>Theme</span>
        </button>

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button class="btn btn-sm w-100 text-start text-danger">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        @endauth

    </div>
</aside>

<script>
    function toggleSidebarDropdown(button) {
        const dropdown = button.closest('.sidebar-dropdown');

        dropdown.classList.toggle('open');
    }
</script>