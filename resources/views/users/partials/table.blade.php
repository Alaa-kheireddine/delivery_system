<div class="card-box p-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0" id="mainTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Password</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="text-muted small">
                            #{{ $user->id }}
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->branch->name ?? '-' }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td >{{ $user->salary ?? '-'}}</td>
                        <td>
                            @if($user->is_active)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td>
                            @if ($user->must_change_password)
                                <span class="badge bg-warning text-dark">Must Change</span>
                            @elseif ($user->password_changed_at)
                                <span class="badge bg-success">Changed</span>
                            @else
                                <span class="badge bg-secondary">Not Changed</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>

                        <td>{{ $user->updated_at->diffForHumans() }}</td>

                        <td class="text-end">
                            
                            <div class="d-flex justify-content-end gap-2">
                                @php
                                    $actions = [
                                        'canUpdate' => auth()->user()->can('update', $user),
                                        'canDeactivate' => auth()->user()->can('deactivate', $user) && $user->is_active,
                                        'canActivate' => auth()->user()->can('activate', $user) && ! $user->is_active,
                                    ];

                                    $hasActions = in_array(true, $actions, true);
                                @endphp

                                @if ($hasActions)
                                    @can('update', $user)
                                        <button class="btn btn-light btn-sm action-btn edit-btn"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-phone="{{ $user->phone }}"
                                                data-email="{{ $user->email }}"
                                                data-role-id="{{ $user->role_id }}"
                                                data-branch-id="{{ $user->branch_id }}"
                                                data-status="{{ $user->is_active }}"
                                                data-salary="{{ $user->salary }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    @endcan

                                    @can('deactivate', $user)
                                        @if($user->is_active)
                                            <form action="{{ route('users.deactivate', $user) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-danger status-btn">
                                                    Deactivate
                                                </button>
                                            </form>
                                        @endif
                                    @endcan

                                    @can('activate', $user)
                                        @if(! $user->is_active)
                                            <form action="{{ route('users.activate', $user) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-success status-btn">
                                                    Activate
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                @else
                                    <span class="text-muted">—</span>
                                @endif

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-5">
                            <div>
                                <i class="bi bi-people fs-1 d-block mb-2 text-muted"></i>
                                <div class="fw-semibold">No users found.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="card-footer d-flex justify-content-between align-items-center mt-2 mb-2 ms-2">
        <small class="text-muted">
            Showing {{ $users->firstItem() ?? 0 }}
            to {{ $users->lastItem() ?? 0 }}
            of {{ $users->total() }} results
        </small>

        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
    </div>
</div>