@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/roles.css') }}">
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
