@extends('layouts.app')

@section('styles')
<style>
    .profile-page {
    --primary: #0d6efd;
    --soft-bg: #f6f8fb;
    --card-border: #edf0f5;
    --text-muted: #6c757d;
}

.profile-hero {
    background: linear-gradient(135deg, #ffffff, #f4f7ff);
    border: 1px solid var(--card-border);
    border-radius: 24px;
    padding: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    box-shadow: 0 12px 35px rgba(16, 24, 40, 0.04);
}

.profile-hero p {
    color: var(--text-muted);
}

.profile-card {
    background: #ffffff;
    border: 1px solid var(--card-border);
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 12px 35px rgba(16, 24, 40, 0.05);
}

.profile-summary {
    text-align: center;
}

.avatar-ring {
    width: 116px;
    height: 116px;
    border-radius: 50%;
    padding: 6px;
    background: linear-gradient(135deg, rgba(13,110,253,.25), rgba(13,110,253,.05));
}

.profile-avatar {
    width: 104px;
    height: 104px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0d6efd, #5b8cff);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    font-weight: 800;
    box-shadow: inset 0 0 0 4px rgba(255,255,255,.35);
}

.status-pill {
    border-radius: 999px;
    padding: 9px 16px;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
}

.status-pill.active {
    background: #e8f8ef;
    color: #198754;
}

.status-pill.inactive {
    background: #fdecec;
    color: #dc3545;
}

.summary-meta {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.summary-meta div,
.info-tile,
.security-box {
    background: var(--soft-bg);
    border: 1px solid var(--card-border);
    border-radius: 18px;
}

.summary-meta div {
    padding: 16px;
}

.summary-meta span,
.info-tile span {
    display: block;
    color: var(--text-muted);
    font-size: 13px;
    margin-bottom: 5px;
}

.summary-meta strong,
.info-tile strong {
    color: #1f2937;
    font-size: 15px;
}

.info-tile {
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    height: 100%;
    transition: .2s ease;
}

.info-tile:hover {
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(16, 24, 40, 0.06);
}

.tile-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 14px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    box-shadow: 0 6px 16px rgba(16, 24, 40, 0.06);
}

.security-box {
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
}

@media (max-width: 767px) {
    .profile-hero,
    .security-box {
        flex-direction: column;
        align-items: stretch;
    }

    .profile-hero {
        padding: 20px;
    }

    .profile-card {
        padding: 22px;
        border-radius: 20px;
    }

    .summary-meta {
        grid-template-columns: 1fr;
    }

    .security-box .btn {
        width: 100%;
    }
}
</style>
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
                            <div class="col-md-12">
                                <label class="form-label text-muted">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted">New Password</label>
                                <input type="password" class="form-control" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
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