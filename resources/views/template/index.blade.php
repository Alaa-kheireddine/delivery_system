@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<div class="container-fluid py-4">

    <!-- Header -->
    @include('template.partials.header')

    <!-- Stats -->
    @include('template.partials.stats')

    <!-- Filters -->
    @include('template.partials.filters')

    <!-- Bulk Actions -->
    @include('template.partials.bulk-actions')

    <div class="card-box p-0">
        <!-- Table -->
        @include('template.partials.table')
    </div>

    <!-- Modals -->
    @include('template.partials.modals')

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/template.js') }}"></script>
@endsection
