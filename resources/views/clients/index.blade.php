@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    @include('clients.partials.header')

    <div class="card-box p-0">

        @if (in_array(Auth::user()->role->name, ['admin', 'manager', 'accountant']))
            <!-- Filters -->
            @include('clients.partials.filters', ['branches' => $branches])
        @endif

        <!-- Table -->
        @include('clients.partials.table', ["clients" => $clients])
    </div>

    <!-- Modals -->
    @include('clients.partials.modals')

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/clients.js') }}"></script>
@endsection
