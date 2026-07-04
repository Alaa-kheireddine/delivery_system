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
                        <div class="col-12 d-none" id="clientFields">
                            <hr>

                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-truck me-1"></i>
                                Client Company Info
                            </h6>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" name="client_company_name" class="form-control"
                                           value="{{ old('client_company_name') }}"
                                           placeholder="Enter company name">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Company Phone</label>
                                    <input type="text" name="client_company_phone" class="form-control"
                                           value="{{ old('client_company_phone') }}"
                                           placeholder="Enter company phone">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Company Address</label>
                                    <input type="text" name="client_company_address" class="form-control"
                                           value="{{ old('client_company_address') }}"
                                           placeholder="Enter company address">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Default Pickup City</label>
                                    <input type="text" name="default_pickup_city" class="form-control"
                                           value="{{ old('default_pickup_city') }}"
                                           placeholder="Example: Saida">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Default Pickup Address</label>
                                    <input type="text" name="default_pickup_address" class="form-control"
                                           value="{{ old('default_pickup_address') }}"
                                           placeholder="Default pickup address">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Payment Type</label>
                                    <select name="payment_type" class="form-select">
                                        <option value="">Select payment type</option>
                                        <option value="cash" {{ old('payment_type') === 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="bank" {{ old('payment_type') === 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="wallet" {{ old('payment_type') === 'wallet' ? 'selected' : '' }}>Wallet</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>

                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check2-circle me-1"></i>
                        Save User
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('createUserRole');

    if (roleSelect) {
        
        roleSelect.addEventListener('change', function(){

            const clientFields = document.getElementById('clientFields');

            if (!clientFields) return;

            const selectedOption = roleSelect.options[roleSelect.selectedIndex];
            const roleName = selectedOption?.dataset.roleName?.toLowerCase();

            if (roleName === 'client') {
                clientFields.classList.remove('d-none');
            } else {
                clientFields.classList.add('d-none');
            }

        });

    }
});
</script>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">Branch Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Top Summary --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-building fs-4"></i>
                        </div>

                        <div>
                            <h5 class="mb-1" id="viewName">-</h5>
                            <small class="text-muted">
                                Branch ID: <span id="viewID">-</span>
                            </small>
                        </div>
                    </div>

                    <span class="badge rounded-pill px-3 py-2" id="viewStatusBadge">
                        -
                    </span>
                </div>

                {{-- Info Cards --}}
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-geo-alt me-1"></i> City
                            </small>
                            <div class="fw-semibold" id="viewCity">-</div>
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

                    <div class="col-md-12">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-map me-1"></i> Address
                            </small>
                            <div class="fw-semibold" id="viewAddress">-</div>
                        </div>
                    </div>

                </div>

                {{-- Quick Stats --}}
                <div class="row g-3 mt-2">

                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <small class="text-muted d-block">Users</small>
                            <div class="fw-bold fs-5" id="viewUsersCount">0</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <small class="text-muted d-block">Shipments</small>
                            <div class="fw-bold fs-5" id="viewShipmentsCount">0</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <small class="text-muted d-block">Active Shipments</small>
                            <div class="fw-bold fs-5" id="viewActiveShipmentsCount">0</div>
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

            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <form action="#" id="editForm" method="POST" class="form form-control">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="editName" placeholder="new name here" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control" id="editEmail" placeholder="new-email@example.com" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Salary</label>
                                <input type="number" name="salary" class="form-control" id="editSalary" placeholder="Enter salary" min="0" step="1">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="editPhone" placeholder="03123456">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Branch</label>
                                <select name="branch_id" id="editBranch" class="form-select">
                                    <option value="">Select branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ $branch->name }} - {{ $branch->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                <select name="role_id" id="editRole" class="form-select" required>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

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
