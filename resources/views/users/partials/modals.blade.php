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
