<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Seperator -->
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="flex-grow-1 border-top"></div>

                                <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-light border text-muted small fw-semibold">
                                    <i class="bi bi-person-circle"></i>
                                    <span>User Information</span>
                                </div>

                                <div class="flex-grow-1 border-top"></div>
                            </div>
                        </div>

                        {{-- Basic User Info --}}
                        <div class="col-md-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name') }}"
                                   placeholder="Enter full name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}"
                                   placeholder="Enter email address" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone') }}"
                                   placeholder="Enter phone number">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role_id" id="createUserRole" class="form-select" required>
                                <option value="">Select role</option>

                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                            data-role-name="{{ $role->name }}"
                                            data-option-role-name="{{ $role->name }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="salary" class="form-label">
                                Salary
                            </label>

                            <input
                                type="number"
                                class="form-control "
                                id="salary"
                                name="salary"
                                value="{{ old('salary') }}"
                                placeholder="Enter salary"
                                min="0"
                                step="1"
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Branch</label>
                            <select name="branch_id" class="form-select">
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                            {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }} - {{ $branch->city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        {{-- Client Extra Info --}}
                        <div class="row g-3 col-12 d-none" id="createClientFields"">
                            <!-- Seperator -->
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 my-3">
                                    <div class="flex-grow-1 border-top"></div>

                                    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-light border text-muted small fw-semibold">
                                        <i class="bi bi-building"></i>
                                        <span>Client Information</span>
                                    </div>

                                    <div class="flex-grow-1 border-top"></div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">
                                    Client Name 
                                    <label class="text-muted">(Company / Store name)</label>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="client_name" class="form-control" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Code <span class="text-danger">*</span></label>
                                <input type="text" name="client_code" class="form-control" value="{{ $last_client_code ?? '' }}" placeholder="CL-0001" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Contact Person</label>
                                <input type="text" name="client_contact_person_name" class="form-control">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="client_phone" class="form-control">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="client_email" class="form-control">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="client_city" class="form-control">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="client_address" class="form-control">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Branch</label>
                                <select name="client_branch_id" class="form-select">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label">Default Delivery Fee <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="client_default_delivery_fee" class="form-control" placeholder="4.00" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Notes</label>
                                <textarea name="client_notes" class="form-control" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>

                    <button class="btn btn-primary" id="createSaveBtn" type="submit">
                        <i class="bi bi-check2-circle me-1"></i>
                        Save User
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Top Summary --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-person-circle fs-5"></i>
                        </div>

                        <div>
                            <h5 class="mb-1" id="viewName"></h5>
                            <small class="text-muted">
                                User ID: <span id="viewID">-</span>
                            </small>
                        </div>
                    </div>

                    <span class="badge rounded-pill px-3 py-2" id="viewStatusBadge">
                        -
                    </span>
                </div>

                {{-- User Info Cards --}}
                <div class="row g-3 mt-2">

                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-buildings me-1"></i> Branch
                            </small>
                            <div class="fw-semibold" id="viewBranch">-</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-envelope me-1"></i> Email
                            </small>
                            <div class="fw-semibold" id="viewEmail">-</div>
                        </div>
                    </div>

                </div>

                <div class="row g-3 mt-2">

                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-shield-check me-1"></i> Role
                            </small>
                            <div class="fw-semibold" id="viewRole">-</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-telephone me-1"></i> Phone
                            </small>
                            <div class="fw-semibold" id="viewPhone">-</div>
                        </div>
                    </div>

                </div>

                <div class="row g-3 mt-2">

                    <div class="col-md-6 " id="viewSalarySection">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-cash-coin me-1"></i> Salary
                            </small>
                            <div class="fw-semibold" id="viewSalary">-</div>
                        </div>
                    </div>

                </div>

                {{-- Client Info --}}

                <div id="viewClientSection">
                    <!-- Seperator -->
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2 my-3">
                            <div class="flex-grow-1 border-top"></div>

                            <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-light border text-muted small fw-semibold">
                                <i class="bi bi-building"></i>
                                <span>Client Information</span>
                            </div>

                            <div class="flex-grow-1 border-top"></div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-upc-scan me-1"></i> Client Code
                                </small>
                                <div class="fw-semibold" id="viewClientCode">-</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-buildings me-1"></i> Client Name
                                </small>
                                <div class="fw-semibold" id="viewClientName">-</div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mt-2">

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-person-badge me-1"></i> Contact Person
                                </small>
                                <div class="fw-semibold" id="viewClientContactPerson">-</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-person-badge me-1"></i> Phone
                                </small>
                                <div class="fw-semibold" id="viewClientPhone">-</div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mt-2">

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-truck me-1"></i> Delivery Fee
                                </small>
                                <div class="fw-semibold" id="viewClientDeliveryFee">-</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-truck me-1"></i> Email
                                </small>
                                <div class="fw-semibold" id="viewClientEmail">-</div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mt-2">

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-geo-alt me-1"></i> Address
                                </small>
                                <div class="fw-semibold" id="viewClientAddress">-</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-geo-alt-fill me-1"></i> City
                                </small>
                                <div class="fw-semibold" id="viewClientCity">-</div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mt-2">

                        <div class="col-md-12">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-cash-card-text me-1"></i> Notes
                                </small>
                                <div class="fw-semibold text-break" style="white-space: pre-line;" id="viewClientNotes">-</div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    {{-- Top Summary --}}
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                 style="width: 52px; height: 52px;">
                                <i class="bi bi-person-circle fs-5"></i>
                            </div>

                            <div>
                                <h5 class="mb-1" id="editTopName">Edit User</h5>
                                <small class="text-muted">
                                    User ID: <span id="editUserID">-</span>
                                </small>
                            </div>
                        </div>

                    </div>

                    {{-- User Info --}}
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <label class="form-label text-muted small">
                                    <i class="bi bi-person me-1"></i> Name
                                </label>
                                <input type="text" name="name" id="editName" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <label class="form-label text-muted small">
                                    <i class="bi bi-envelope me-1"></i> Email
                                </label>
                                <input type="email" name="email" id="editEmail" class="form-control" required>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <label class="form-label text-muted small">
                                    <i class="bi bi-buildings me-1"></i> Branch
                                </label>
                                <select name="branch_id" id="editBranchID" class="form-select">
                                    <option value="">No Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <label class="form-label text-muted small">
                                    <i class="bi bi-telephone me-1"></i> Phone
                                </label>
                                <input type="text" name="phone" id="editPhone" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mt-2">

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100" id="editUserRoleSection">
                                <label class="form-label text-muted small">
                                    <i class="bi bi-shield-check me-1"></i> Role
                                </label>
                                <select name="role_id" id="editUserRole" class="form-select" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" data-option-role-name="{{ $role->name }}">
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6" id="editSalarySection">
                            <div class="border rounded-3 p-3 h-100">
                                <label class="form-label text-muted small">
                                    <i class="bi bi-cash-coin me-1"></i> Salary
                                </label>
                                <input type="number" step="0.01" name="salary" id="editSalary" class="form-control">
                            </div>
                        </div>

                    </div>

                    {{-- Client Info --}}
                    <div id="editClientFields">
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-2 my-3">
                                <div class="flex-grow-1 border-top"></div>

                                <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-light border text-muted small fw-semibold">
                                    <i class="bi bi-building"></i>
                                    <span>Client Information</span>
                                </div>

                                <div class="flex-grow-1 border-top"></div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-upc-scan me-1"></i> Client Code
                                    </label>
                                    <input type="text" name="client_code" id="editClientCode" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-buildings me-1"></i> Client Name
                                    </label>
                                    <input type="text" name="client_name" id="editClientName" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row g-3 mt-2">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-person-badge me-1"></i> Contact Person
                                    </label>
                                    <input type="text" name="client_contact_person_name" id="editClientContactPerson" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-telephone me-1"></i> Phone
                                    </label>
                                    <input type="text" name="client_phone" id="editClientPhone" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row g-3 mt-2">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-truck me-1"></i> Delivery Fee
                                    </label>
                                    <input type="number" step="0.01" name="client_default_delivery_fee" id="editClientDeliveryFee" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-envelope me-1"></i> Email
                                    </label>
                                    <input type="email" name="client_email" id="editClientEmail" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row g-3 mt-2">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-geo-alt me-1"></i> Address
                                    </label>
                                    <input type="text" name="client_address" id="editClientAddress" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-geo-alt-fill me-1"></i> City
                                    </label>
                                    <input type="text" name="client_city" id="editClientCity" class="form-control">
                                </div>
                            </div>

                        </div>
                        
                        <div class="row g-3 mt-2">
                            <div class="col-12 col-md-6">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-buildings me-1"></i> Branch
                                    </label>
                                    <select name="client_branch_id" id="editClientBranchId" class="form-select">
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">
                                                {{ $branch->name }} - {{ $branch->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">

                            <div class="col-md-12">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-cash-card-text me-1"></i> Notes
                                    </label>
                                    <textarea name="client_notes" id="editClientNotes" class="form-control" rows="6"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    @can('resetPassword', App\Models\User::class)
                        <button type="button"
                                class="btn btn-outline-warning me-auto"
                                id="resetPasswordButton">
                            <i class="bi bi-key me-1"></i> Reset Password
                        </button>
                    @endcan
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="editSaveBtn" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Save Changes
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Confirmation</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this Branch?
                <div class="fw-bold mt-2" id="deleteItemName">-</div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" onclick="showToast('Deleted successfully')">
                    Delete
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Reset Password Modal --}}
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="resetPasswordForm" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        Are you sure you want to reset password for
                        <strong id="resetPasswordUserName"></strong>?
                    </p>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Enter new password"
                               required>
                    </div>

                    <div>
                        <label class="form-label">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Confirm new password"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-warning">
                        Reset Password
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
