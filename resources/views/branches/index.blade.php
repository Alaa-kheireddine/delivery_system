@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<div class="container-fluid py-4">

    <!-- Header -->
    @include('branches.partials.header')

    <div class="card-box p-0">
        <!-- Table -->
        @include('branches.partials.table', ["branches" => $branches])
    </div>

    <!-- Stats -->
    @if(Auth::user()->role->name === 'admin')
        <div class="mt-5">
            @include('branches.partials.stats', 
                    ["total_branches" => $total_branches,
                    "total_active_branches" => $total_active_branches])
        </div>
    @endif

    @include('branches.partials.charts', $chartData)

    <!-- Modals -->
    @include('branches.partials.modals')

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/branches.js') }}"></script>
@endsection
