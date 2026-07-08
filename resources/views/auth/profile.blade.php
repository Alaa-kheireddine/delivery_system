@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
<div class="container-fluid py-4">

    <div class="profile-page">

        <div class="profile-hero mb-4">
            <div>
                <h4 class="fw-bold mb-1">My Profile</h4>
                <p class="mb-0">Manage your personal information, role, branch, and account security.</p>
            </div>

            <span class="status-pill {{ $user->is_active ? 'active' : 'inactive' }}">
                {{ $user->is_active ? 'Active Account' : 'Inactive Account' }}
            </span>
        </div>

        <div class="row g-4">

            <div class="col-12 col-xl-4">
                <div class="profile-card profile-summary h-100">

                    <div class="avatar-ring mx-auto mb-3">
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>

                    <h5 class="fw-bold mb-1">{{ ucwords($user->name) }}</h5>
                    <p class="text-muted mb-4 text-break">{{ $user->email }}</p>

                    <div class="summary-meta">
                        <div>
                            <span>Role</span>
                            <strong>{{ ucwords($user->role->name ?? 'No Role') }}</strong>
                        </div>

                        <div>
                            <span>Branch</span>
                            <strong>{{ ucwords($user->branch->name ?? 'No Branch') }}</strong>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="profile-card h-100">

                    <div class="section-head mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">Account Information</h5>
                            <p class="text-muted mb-0">Your system identity and assigned permissions scope.</p>
                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="col-12 col-md-6">
                            <div class="info-tile">
                                <div class="tile-icon"><i class="bi bi-person"></i></div>
                                <div>
                                    <span>Full Name</span>
                                    <strong>{{ ucwords($user->name) }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="info-tile">
                                <div class="tile-icon"><i class="bi bi-envelope"></i></div>
                                <div>
                                    <span>Email Address</span>
                                    <strong class="text-break">{{ $user->email }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="info-tile">
                                <div class="tile-icon"><i class="bi bi-shield-lock"></i></div>
                                <div>
                                    <span>Role</span>
                                    <strong>{{ ucwords($user->role->name ?? 'No Role') }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="info-tile">
                                <div class="tile-icon"><i class="bi bi-person-badge"></i></div>
                                <div>
                                    <span>Branch</span>
                                    <strong>{{ ucwords($user->branch->name ?? 'No Branch') }}</strong>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="security-box mt-4">
                        <div>
                            <h6 class="fw-bold mb-1">Security Settings</h6>
                            <p class="text-muted mb-0">Update your password to keep your account secure.</p>
                        </div>

                        <a class="btn btn-primary px-4 {{ $errors->any() ? '' : 'collapsed' }}"
                           data-bs-toggle="collapse"
                           href="#changePasswordBox"
                           aria-expanded="{{ $errors->any() ? 'true' : 'false' }}">
                            Change Password
                        </a>
                    </div>

                </div>
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