@extends('layouts.app')

@section('styles')
<style>
    .role-card {
    background: #fff;
    border-radius: 18px;
    padding: 24px;
    border: 1px solid #eef0f3;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    transition: 0.2s ease;
}

.role-card:hover {
    transform: translateY(-3px);
}

.role-badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    background: #eef4ff;
    color: #0d6efd;
    font-size: 12px;
    font-weight: 600;
}

.role-stat {
    background: #f8f9fa;
    border-radius: 14px;
    padding: 14px;
}

.role-stat small {
    display: block;
    color: #6c757d;
}

.role-stat strong {
    font-size: 18px;
}

.permission-pill {
    padding: 7px 12px;
    border-radius: 999px;
    background: #f8f9fa;
    border: 1px solid #e5e7eb;
    font-size: 13px;
    font-weight: 500;
}
</style>
@endsection

@section('content')

<div class="container-fluid py-4">
    

    <!-- Header -->
    @include('roles.partials.header')

    <div class="card-box p-0">
        <!-- Table -->
        @include('roles.partials.table', ["roles" => $roles])
    </div>

    <!-- Modals -->
    @include('roles.partials.modals', ["permissions" => $permissions])

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/roles.js') }}"></script>
@endsection
