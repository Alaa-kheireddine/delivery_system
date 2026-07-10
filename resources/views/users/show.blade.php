@extends('layouts.app')
@section('content')

<!-- Header -->
<div class="card-box p-4 mb-4">
    @include('components.breadcrumb', [
        'items' => [
            [
                'label' => 'Users',
                'url' => session('users_index_url', route('users.index')),
            ],
            [
                'label' => 'Show',
                'active' => true,
            ],
        ]
    ])

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start gap-3">

        <div class="d-flex align-items-start gap-3">
            <div>
                <h4 class="mb-1">
                    {{ ucwords($user->name) }} Profile
                </h4>

                <p class="text-muted mb-0">
                    Review account details, assigned role, branch access, security status, and activity.
                </p>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">

            @can('update', $user)
                <a href="{{ route('users.edit', $user) }}"
                   class="btn btn-outline-primary">
                    <i class="bi bi-pencil me-1"></i>
                    Edit User
                </a>
            @endcan
        </div>

    </div>
</div>


<!-- User Summary Card -->
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card-box p-3 h-100">
            <small class="text-muted">Role</small>
            <h5 class="mb-0">{{ ucwords($user->role?->name ?? 'No Role') }}</h5>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card-box p-3 h-100">
            <small class="text-muted">Branch</small>
            <h5 class="mb-0">{{ $user->branch?->name ?? 'No Branch' }}</h5>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card-box p-3 h-100">
            <small class="text-muted">Account Status</small>
            <h5 class="mb-0">
                {{ $user->is_active ? 'Active' : 'Inactive' }}
            </h5>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card-box p-3 h-100">
            <small class="text-muted">Password Status</small>
            <h5 class="mb-0">
                {{ $user->must_change_password ? 'Change Required' : 'Normal' }}
            </h5>
        </div>
    </div>
</div>

<!-- User Personal Information -->
<div class="card-box p-4 mb-4">
    <h5 class="mb-4">Personal Information</h5>

    <div class="row g-4">
        <div class="col-md-6">
            <small class="text-muted">Full Name</small>
            <div class="fw-semibold">{{ ucwords($user->name) }}</div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Email Address</small>
            <div class="fw-semibold text-break">{{ $user->email }}</div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Phone</small>
            <div class="fw-semibold">{{ $user->phone ?: '—' }}</div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Salary</small>
            <div class="fw-semibold">
                {{ $user->salary !== null ? '$'.number_format($user->salary, 2) : '—' }}
            </div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Created At</small>
            <div class="fw-semibold">
                {{ $user->created_at?->format('d M Y, h:i A') ?? '—' }}
            </div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Last Updated</small>
            <div class="fw-semibold">
                {{ $user->updated_at?->format('d M Y, h:i A') ?? '—' }}
            </div>
        </div>
    </div>
</div>

<!-- User Access Information -->
<div class="card-box p-4 mb-4">
    <h5 class="mb-4">Access Information</h5>

    <div class="row g-4">
        <div class="col-md-4">
            <small class="text-muted">Assigned Role</small>
            <div class="fw-semibold">
                {{ ucwords($user->role?->name ?? 'No Role') }}
            </div>
        </div>

        <div class="col-md-4">
            <small class="text-muted">Assigned Branch</small>
            <div class="fw-semibold">
                {{ $user->branch?->name ?? 'No Branch' }}
            </div>
        </div>

        <div class="col-md-4">
            <small class="text-muted">Linked Client</small>
            <div class="fw-semibold">
                {{ $user->client?->name ?? 'Not linked to a client' }}
            </div>
        </div>
    </div>
</div>

<!-- User Security Information -->
<div class="card-box p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5 class="mb-1">Security Information</h5>
            <p class="text-muted mb-0">
                Password status and account security details.
            </p>
        </div>

        @can('resetPassword', App\Models\User::class)
            <a href="{{ route('users.edit', $user) }}"
               class="btn btn-outline-warning">
                <i class="bi bi-key me-1"></i>
                Reset Password
            </a>
        @endcan
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <small class="text-muted">Must Change Password</small>

            <div class="mt-1">
                @if($user->must_change_password)
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                        Required
                    </span>
                @else
                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                        Not Required
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Temporary Password Expires At</small>
            <div class="fw-semibold">
                {{ $user->temporary_password_expires_at?->format('d M Y, h:i A') ?? '—' }}
            </div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Password Changed At</small>
            <div class="fw-semibold">
                {{ $user->password_changed_at?->format('d M Y, h:i A') ?? 'Never changed' }}
            </div>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Account State</small>
            <div class="fw-semibold">
                {{ $user->is_active ? 'Active account' : 'Inactive account' }}
            </div>
        </div>
    </div>
</div>

@endsection
