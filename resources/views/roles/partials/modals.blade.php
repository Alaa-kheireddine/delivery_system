{{-- Create Role Modal --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Create New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-12">
                            <label class="form-label">Role Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Example: delivery_agent"
                                required
                            >
                            <small class="text-muted">
                                Use lowercase letters, numbers, and underscores only. Example: delivery_agent
                            </small>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label mb-3">Assign Permissions</label>

                            @foreach ($permissions as $group => $groupPermissions)
                                <div class="border rounded-4 p-3 mb-3">
                                    <h6 class="fw-bold mb-3 text-capitalize">
                                        {{ $group }} Permissions
                                    </h6>

                                    <div class="row g-2">
                                        @foreach ($groupPermissions as $permission)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="create_permission_{{ $permission->id }}"
                                                    >

                                                    <label
                                                        class="form-check-label"
                                                        for="create_permission_{{ $permission->id }}"
                                                    >
                                                        {{ ucwords(str_replace(['.', '_', '-'], ' ', $permission->name)) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Create Role
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Edit Role Modal --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-12">
                            <label class="form-label">Role Name</label>
                            <input
                                type="text"
                                name="name"
                                id="editRoleName"
                                class="form-control"
                                placeholder="Example: delivery_agent"
                                required
                            >
                            <small class="text-muted">
                                Use lowercase letters, numbers, and underscores only. Example: delivery_agent
                            </small>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label mb-3">Update Permissions</label>

                            @foreach ($permissions as $group => $groupPermissions)
                                <div class="border rounded-4 p-3 mb-3">
                                    <h6 class="fw-bold mb-3 text-capitalize">
                                        {{ $group }} Permissions
                                    </h6>

                                    <div class="row g-2">
                                        @foreach ($groupPermissions as $permission)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input edit-permission"
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="edit_permission_{{ $permission->id }}"
                                                    >

                                                    <label
                                                        class="form-check-label"
                                                        for="edit_permission_{{ $permission->id }}"
                                                    >
                                                        {{ ucwords(str_replace(['.', '_', '-'], ' ', $permission->name)) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Update Role
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Delete Role Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="deleteRoleForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Delete Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-0">
                        Are you sure you want to delete
                        <strong id="deleteRoleName"></strong>?
                    </p>

                    <small class="text-muted">
                        This action cannot be undone.
                    </small>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Delete Role
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>