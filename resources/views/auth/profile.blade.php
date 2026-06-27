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
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted">New Password</label>
                                <input type="password" class="form-control" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
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