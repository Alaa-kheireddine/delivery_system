@extends('layouts.app')

@section('content')
<div class="card-box p-4 m-2 mt-4">

    @include('components.breadcrumb', [
        'items' => [
            [
                'label' => 'Users',
                'url' => session('users_index_url', route('users.index')),
            ],
            [
                'label' => $user->name,
                'url' => route('users.show', $user),
            ],
            [
                'label' => 'Edit',
                'active' => true,
            ],
        ]
    ])

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="mb-1">{{ $user->name }} (#{{ $user->id }})</h4>
            <p class="text-muted mb-0">{{ $user->email }}</p>
        </div>

        @if($user->is_active)
            <span class="badge bg-success-subtle text-success border border-success-subtle">
                Active
            </span>
        @else
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                Inactive
            </span>
        @endif
    </div>

    <form action="{{ route('users.update', $user) }}" method="POST" class="mt-5">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $user->email) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Salary</label>
                <input type="text"
                       name="salary"
                       class="form-control"
                       value="{{ old('salary', $user->salary) }}"
                       placeholder="-">
            </div>

            @if ($user->role->name !== 'client')
                <div class="col-md-6">
                    <label class="form-label text-muted small">
                        <i class="bi bi-person-badge me-1"></i> Role
                    </label>

                    <select name="role_id" class="form-select">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                @selected(old('role_id', $user->role_id) == $role->id)>
                                {{ ucwords($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="col-md-6">
                <label class="form-label text-muted small">
                    <i class="bi bi-buildings me-1"></i> Branch
                </label>

                <select name="branch_id" class="form-select">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}"
                            @selected(old('branch_id', $user->branch_id) == $branch->id)>
                            {{ $branch->name }} - {{ $branch->city }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-5">

            @can('resetPassword', $user)
                <button type="button"
                        class="btn btn-outline-warning me-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#resetPasswordModal">
                    <i class="bi bi-key me-1"></i>
                    Reset Password
                </button>
            @endcan

            <a href="{{ route('users.show', $user) }}" class="btn btn-light">
                Cancel
            </a>

            <button class="btn btn-primary" type="submit">
                Update
            </button>
        </div>
    </form>
</div>

{{-- Reset Password Modal --}}
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="{{ route('users.reset-password', $user) }}">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        Are you sure you want to reset password for
                        <strong>{{ $user->name }}</strong>?
                    </p>
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
@endsection