@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                     style="width: 64px; height: 64px; font-size: 24px;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <h5 class="mb-1 fw-bold">{{ ucwords( $user->name ) }}</h5>
                    <span class="badge bg-success-subtle text-success">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                </div>
            </div>

            <hr>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 rounded-3 bg-light border">
                        <small class="text-muted d-block mb-1">Full Name</small>
                        <div class="fw-semibold">{{ ucwords( $user->name ) }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-3 bg-light border">
                        <small class="text-muted d-block mb-1">Email</small>
                        <div class="fw-semibold">{{ ucwords( $user->email ) }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-3 bg-light border">
                        <small class="text-muted d-block mb-1">Role</small>
                        <div class="fw-semibold">{{ ucwords( $user->role->name ) }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-3 bg-light border">
                        <small class="text-muted d-block mb-1">Branch</small>
                        <div class="fw-semibold">{{ ucwords( $user->branch->name ) }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a class="btn btn-outline-secondary {{ $errors->any() ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse"
                    href="#changePasswordBox"
                    aria-expanded="{{ $errors->any() ? 'true' : 'false' }}">
                        Change Password
                </a>
            </div>

        </div>
    </div>
</div>

<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="collapse mt-4 {{ $errors->any() ? 'show' : '' }}" id="changePasswordBox">
            <div class="card border-0  rounded-4">
                <div class="card-body p-4">

                    <h6 class="fw-bold mb-3">Change Password</h6>

                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method("PUT")

                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label fw-semibold text-muted">Current Password</label>

                                <div class="input-group input-group-lg">
                                    <input
                                        type="password"
                                        id="current_password"
                                        name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="Enter current password"
                                        required
                                    >

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('current_password', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted">New Password</label>

                                <div class="input-group input-group-lg">
                                    <input
                                        type="password"
                                        id="new_password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter new password"
                                        required
                                    >

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('new_password', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted">Confirm Password</label>

                                <div class="input-group input-group-lg">
                                    <input
                                        type="password"
                                        id="confirm_password"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm new password"
                                        required
                                    >

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            onclick="togglePassword('confirm_password', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg px-4 fw-semibold">
                                <i class="bi bi-shield-lock me-1"></i>
                                Save Password
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection