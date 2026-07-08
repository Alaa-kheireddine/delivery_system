<div class="card-box m-3">
    <div class="row g-4">
        
        @foreach ($roles as $index => $role)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="role-card h-100">

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mt-2 mb-1">{{ $role->name }}</h5>
                            <!-- <p class="text-muted small mb-0">
                                Full access to manage the whole system.
                            </p> -->
                        </div>

                        <div class="dropdown">
                            @if (auth()->user()->can('update', $role) || 
                                auth()->user()->can('delete', $role)
                            )
                                <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                            @endif

                            <ul class="dropdown-menu dropdown-menu-end">
                                @can('update', $role)
                                    <li>
                                        <button
                                            type="button"
                                            class="dropdown-item edit-role-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $role->id }}"
                                            data-name="{{ $role->name }}"
                                            data-permissions='@json($role->permissions->pluck("id"))'
                                        >
                                            Edit Role
                                        </button>
                                    </li>
                                @endcan

                                @can('delete', $role)
                                    <li>
                                        <button
                                            type="button"
                                            class="dropdown-item text-danger delete-role-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="{{ $role->id }}"
                                            data-name="{{ $role->name }}"
                                        >
                                            Delete Role
                                        </button>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>

                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <div class="role-stat">
                                <small>Users</small>
                                <strong>{{ $role->users->count() }}</strong>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="role-stat">
                                <small>Permissions</small>
                                <strong>{{ $role->permissions->count() }}</strong>
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-semibold mb-3">Permissions</h6>

                    <div class="d-flex flex-wrap gap-2">
                        @forelse ($role->permissions->groupBy('group') as $group => $groupPermissions)

                            <div class="w-100 mb-2">
                                <small class="text-muted fw-semibold text-uppercase">
                                    {{ $group }}
                                </small>
                            </div>

                            @foreach ($groupPermissions as $permission)
                                <span class="permission-pill">
                                    {{ ucwords(str_replace(['.', '_', '-'], ' ', $permission->name)) }}
                                </span>
                            @endforeach

                        @empty
                            <span class="text-muted small">
                                No permissions assigned yet.
                            </span>
                        @endforelse
                    </div>

                </div>
            </div>
        @endforeach

    </div>
</div>