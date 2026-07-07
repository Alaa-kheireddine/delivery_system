@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<div class="container-fluid py-4">

    @if (session('temporary_password'))
        <div class="alert alert-warning shadow-sm border-0">
            <div class="fw-bold mb-2">
                Temporary Password Created
            </div>

            <p class="mb-2">
                User:
                <strong>{{ session('temporary_user_email') }}</strong>
            </p>

            <div class="input-group">
                <input
                    type="text"
                    class="form-control fw-bold"
                    id="temporaryPassword"
                    value="{{ session('temporary_password') }}"
                    readonly
                >

                <button
                    class="btn btn-dark"
                    type="button"
                    onclick="copyTemporaryPassword()"
                >
                    Copy
                </button>
            </div>

            <small class="text-muted d-block mt-2">
                This password is shown only once. Copy it now.
            </small>
        </div>
    @endif

    <!-- Header -->
    @include('users.partials.header')

    <div class="card-box p-0">
        <!-- Filters -->
         @include('users.partials.filters', ['branches' => $branches, 'roles' => $roles])
        <!-- Table -->
        @include('users.partials.table', ["users" => $users])
    </div>

    <!-- Modals -->
    @include('users.partials.modals', 
                ['branches' => $branches, 
                'roles' => $roles, 
                'last_client_code' => $last_client_code])

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/js/pages/users.js') }}"></script>
    <script>
    function copyTemporaryPassword() {
        const input = document.getElementById('temporaryPassword');
        navigator.clipboard.writeText(input.value);
    }
    </script>
@endsection
