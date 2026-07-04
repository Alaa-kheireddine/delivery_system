@extends('layouts.app')
@section('content')
<div class="card-box p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div class="d-flex align-items-center gap-3">

            <a href="{{ route('branches.index') }}"
               class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>

            <div>
                <h4 class="mb-1">{{ $branch->name }}</h4>
                <p class="text-muted mb-0">
                    {{ $branch->city }} • {{ $branch->address }}
                </p>
            </div>

        </div>

        <div class="d-flex align-items-center gap-2">

            @if($branch->is_active)
                <span class="badge bg-success-subtle text-success border border-success-subtle">
                    Active
                </span>
            @else
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                    Inactive
                </span>
            @endif

        </div>

    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card-box p-3">
            <small class="text-muted">Total Shipments</small>
            <h3 class="mb-0">{{ $total }}</h3>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card-box p-3">
            <small class="text-muted">Active Shipments</small>
            <h3 class="mb-0">{{ $active }}</h3>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card-box p-3">
            <small class="text-muted">Delivered</small>
            <h3 class="mb-0">{{ $delivered }}</h3>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card-box p-3">
            <small class="text-muted">Pending</small>
            <h3 class="mb-0">{{ $pending }}</h3>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-lg-4">
        <div class="card-box p-3 h-100">
            <h6 class="fw-bold mb-3">Branch Information</h6>

            <p><strong>Phone:</strong> {{ $branch->phone }}</p>
            <p><strong>City:</strong> {{ $branch->city }}</p>
            <p><strong>Address:</strong> {{ $branch->address }}</p>
            <p><strong>Created:</strong> {{ $branch->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="card-box p-3">
            <h6 class="fw-bold mb-3">Recent Shipments</h6>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tracking</th>
                            <th>Receiver</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recentShipments as $shipment)
                            <tr>
                                <td><strong>{{ $shipment->tracking_number }}</strong></td>
                                <td>{{ $shipment->receiver_name }}</td>
                                <td>
                                    <span class="badge bg-secondary text-dark">
                                        {{ str_replace('_', ' ', ucfirst($shipment->status)) }}
                                    </span>
                                </td>
                                <td>{{ $shipment->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">no shipments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection