@php
    $shipmentsOpen = request()->routeIs('shipments.*');

    $workOpen = request()->routeIs(
        'missions.*',
        'shipments.active'
    );

    $managementOpen = request()->routeIs(
        'branches.*',
        'clients.*',
        'customers.*',
        'shipment-assignments.*'
    );

    $financeOpen = request()->routeIs(
        'expenses.*',
        'payments.*',
        'cod.*'
    );

    $reportsOpen = request()->routeIs('reports.*');

    $systemOpen = request()->routeIs(
        'recent-actions.*',
        'notifications.*',
        'whatsapp.*',
        'chats.*'
    );

    $adminOpen = request()->routeIs(
        'users.*',
        'roles.*',
        'permissions.*',
        'settings.*'
    );
@endphp

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

        <a href="{{ route('dashboard.index') }}"
            class="sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }} "> 
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>

        {{-- Shipments Dropdown --}}
        <div class="sidebar-dropdown {{ $shipmentsOpen ? 'open' : '' }}">
            <button class="sidebar-link sidebar-dropdown-btn {{ $shipmentsOpen ? 'active' : '' }}"
                    type="button"
                    onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-box-seam"></i>
                <span>Shipments</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </button>

            <div class="sidebar-submenu">
                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('shipments.index') ? 'active' : '' }}">
                    All Shipments
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('shipments.pending') ? 'active' : '' }}">
                    Pending Shipments
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('shipments.active') ? 'active' : '' }}">
                    Active Shipments
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('shipments.delivered') ? 'active' : '' }}">
                    Delivered Shipments
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('shipments.cancelled') ? 'active' : '' }}">
                    Cancelled Shipments
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('shipments.trashed') ? 'active' : '' }}">
                    Deleted Shipments
                </a>
            </div>
        </div>

        {{-- Work --}}
        <div class="sidebar-dropdown {{ $workOpen ? 'open' : '' }}">
            <button class="sidebar-link sidebar-dropdown-btn"
                    type="button"
                    onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-briefcase"></i>
                <span>Work</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </button>
        </div>
        {{-- Management --}}
        @php
            $canViewManagement =
                auth()->user()->can('viewAny', App\Models\Branch::class);
                // || auth()->user()->can('viewAny', App\Models\Client::class)
                // || auth()->user()->can('viewAny', App\Models\Customer::class);
        @endphp
        {{-- Management --}}
        @if (auth()->user()->role->name === 'admin' || auth()->user()->role->name === 'manager')
            <div class="sidebar-dropdown {{ $managementOpen ? 'open' : '' }}">
                <button class="sidebar-link sidebar-dropdown-btn "
                        type="button"
                        onclick="toggleSidebarDropdown(this)">
                    <i class="bi bi-diagram-3"></i>
                    <span>Management</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </button>

                <div class="sidebar-submenu">
                    @can('viewAny', App\Models\Branch::class)
                    <a href="{{ route('branches.index') }}"
                       class="sidebar-sublink {{ request()->routeIs('branches.*') ? 'active' : '' }}">
                        Branches
                    </a>
                    @endcan

                    <a href="#"
                       class="sidebar-sublink {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        Clients
                    </a>

                    <a href="#"
                       class="sidebar-sublink {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                        Customers
                    </a>

                    <a href="#"
                       class="sidebar-sublink {{ request()->routeIs('shipment-assignments.*') ? 'active' : '' }}">
                        Assignments
                    </a>
                </div>
            </div>
        @endif

        {{-- Finance --}}
        <div class="sidebar-dropdown {{ $financeOpen ? 'open' : '' }}">
            <button class="sidebar-link sidebar-dropdown-btn {{ $financeOpen ? 'active' : '' }}"
                    type="button"
                    onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-wallet"></i>
                <span>Finance</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </button>

            <div class="sidebar-submenu">
                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                    Expenses
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                    Payments
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('cod.*') ? 'active' : '' }}">
                    Cash Collection
                </a>
            </div>
        </div>

        {{-- Reports --}}
        <div class="sidebar-dropdown {{ $reportsOpen ? 'open' : '' }}">
            <button class="sidebar-link sidebar-dropdown-btn {{ $reportsOpen ? 'active' : '' }}"
                    type="button"
                    onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Reports</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </button>

            <div class="sidebar-submenu">
                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('reports.index') ? 'active' : '' }}">
                    Reports Overview
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('reports.shipments') ? 'active' : '' }}">
                    Shipment Reports
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('reports.finance') ? 'active' : '' }}">
                    Finance Reports
                </a>
            </div>
        </div>

        {{-- System --}}
        <div class="sidebar-dropdown {{ $systemOpen ? 'open' : '' }}">
            <button class="sidebar-link sidebar-dropdown-btn {{ $systemOpen ? 'active' : '' }}"
                    type="button"
                    onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-gear"></i>
                <span>System</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </button>

            <div class="sidebar-submenu">
                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('recent-actions.*') ? 'active' : '' }}">
                    Recent Actions
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                    Notifications
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('whatsapp.*') ? 'active' : '' }}">
                    WhatsApp
                </a>

                <a href="#"
                   class="sidebar-sublink {{ request()->routeIs('chats.*') ? 'active' : '' }}">
                    Chats
                </a>
            </div>
        </div>

        {{-- Administration --}}
        @php
            $canViewAdministration =
                auth()->user()->can('viewAny', App\Models\User::class);
                // || auth()->user()->can('viewAny', App\Models\Client::class)
                // || auth()->user()->can('viewAny', App\Models\Customer::class);
        @endphp
        @if($canViewAdministration)
            <div class="sidebar-dropdown {{ $adminOpen ? 'open' : '' }}">
                <button class="sidebar-link sidebar-dropdown-btn"
                        type="button"
                        onclick="toggleSidebarDropdown(this)">
                    <i class="bi bi-person-gear"></i>
                    <span>Administration</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </button>

                <div class="sidebar-submenu">
                    <a href="{{ route('users.index') }}"
                       class="sidebar-sublink {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        Users
                    </a>

                    <a href="#"
                       class="sidebar-sublink {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                        Roles
                    </a>

                    <a href="#"
                       class="sidebar-sublink {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                        Permissions
                    </a>

                    <a href="#"
                       class="sidebar-sublink {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        Settings
                    </a>
                </div>
            </div>
        @endif

    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer p-3 border-top sidebar-border">

        <a href="{{ route('profile.show') }}"
           class="d-flex align-items-center gap-2 mb-3 text-decoration-none 
                    {{ request()->routeIs('profile.show') ? ' sidebar-link active' : '' }}">

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