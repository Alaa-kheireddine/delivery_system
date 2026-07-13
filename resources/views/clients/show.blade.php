@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="card-box p-4 mb-4">
        <!-- BreadCrumb -->
        @include('components.breadcrumb', [
            'items' => [
                [
                    'label' => 'Clients',
                    'url' => session('clients_index_url', route('clients.index')),
                ],
                [
                    'label' => 'Show',
                    'active' => true,
                ],
            ]
        ])
        
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start gap-3">

            <div class="d-flex align-items-start gap-3">
                {{-- <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a> --}}

                <div>
                    <h4 class="mb-1">
                        {{ ucwords($client->name) }} Profile
                    </h4>

                    <p class="text-muted mb-0">
                        Review client details, financial balance, shipments activity, and branch information.
                    </p>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                @can('edit', $client)
                    <a href="{{ route('clients.edit', $client) }}"
                        class="btn btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i>
                            Edit Client
                    </a>
                @endcan
                <a href="#" class="btn btn-primary">
                    <i class="bi bi-truck me-1"></i> View Shipments
                </a>
                <a href="#"
                    class="btn btn-primary">
                        <i class="bi bi-cash-coin me-1"></i> View Payments
                </a>
                
            </div>
        </div>
    </div>

    {{-- Client Main Info --}}
    <div class="card-box p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
            <div>
                <h5 class="fw-bold mb-1">Client Code: <strong>{{ $client->code }}</strong></h5>
                <p class="text-muted mb-0"></p>
            </div>

            <div>
                @if($client->is_active)
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

        <hr>

        <div class="row g-3">
            <div class="col-md-4">
                <small class="text-muted">Contact Person</small>
                <div class="fw-semibold">{{ ucwords($client->contact_person_name) ?? '-' }}</div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Phone</small>
                <div class="fw-semibold">{{ $client->phone ?? '-' }}</div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Email</small>
                <div class="fw-semibold text-break">{{ $client->email ?? '-' }}</div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">City</small>
                <div class="fw-semibold">{{ ucwords($client->city) ?? '-' }}</div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Branch</small>
                <div class="fw-semibold">{{ ucwords($client->branch->name) ?? '-' }}</div>
            </div>

            <div class="col-md-4">
                <small class="text-muted">Default Delivery Fee</small>
                <div class="fw-semibold">${{ ucwords($client->default_delivery_fee) ?? '-' }}</div>
            </div>

            <div class="col-12">
                <small class="text-muted">Address</small>
                <div class="fw-semibold">{{ ucwords($client->address) ?? '-' }}</div>
            </div>
        </div>
    </div>

    {{-- Financial Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Current Balance</small>
                <h3 class="mb-0">${{ $client->current_balance ?? '0' }}</h3>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Total Earnings</small>
                <h3 class="mb-0">${{ $client->total_client_earnings ?? '0' }}</h3>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Total Paid</small>
                <h3 class="mb-0">${{ $client->total_paid_amount ?? '0' }}</h3>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Remaining Balance</small>
                <h3 class="mb-0">
                    ${{ number_format(($client->total_client_earnings ?? 0) - ($client->total_paid_amount ?? 0), 2) }}
                </h3>
            </div>
        </div>
    </div>

    {{-- Shipment Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Total Shipments</small>
                <h3 class="mb-0">{{ $total_shipments_count ?? '0' }}</h3>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Pending</small>
                <h3 class="mb-0">{{ $pending_shipments_count ?? '0' }}</h3>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Delivered</small>
                <h3 class="mb-0">{{ $delivered_shipments_count ?? '0' }}</h3>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="card-box p-3 h-100">
                <small class="text-muted">Cancelled</small>
                <h3 class="mb-0">{{ $cancelled_shipments_count ?? '0' }}</h3>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- Financial Summary --}}
        <div class="col-12 col-xl-4">
            <div class="card-box p-4 h-100">
                <h5 class="mb-3">Financial Summary</h5>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Total Earnings</span>
                    <strong>${{ $client->total_client_earnings }}</strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Total Paid</span>
                    <strong>${{ $client->total_paid_amount }}</strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Delivery Fee</span>
                    <strong>${{ $client->default_delivery_fee }}</strong>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <span class="fw-semibold">Current Balance</span>
                    <strong>${{ $client->current_balance }}</strong>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div class="col-12 col-xl-8">
            <div class="card-box p-4 h-100">
                <h5 class="mb-3">Client Notes</h5>

                <div class="border rounded p-3 text-start" style="min-height: 170px;">
                    {{ trim($client->notes) ?: 'No notes available.' }}
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Payments --}}
    <div class="card-box p-0 mt-4">
        <div class="p-4 border-bottom">
            <h5 class="mb-1">Recent Payments</h5>
            <p class="text-muted mb-0">Latest financial payments recorded for this client.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Reference</th>
                        <th>Created By</th>
                        <th>Notes</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recent_payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_date->format('d M Y') }}</td>
                            <td>
                                <strong>${{ number_format($payment->amount, 2) }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                    {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                </span>
                            </td>
                            <td>{{ $payment->reference ?? '-' }}</td>
                            <td>{{ $payment->creator?->name ?? '-' }}</td>
                            <td>{{ $payment->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No payments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Shipments --}}
    <div class="card-box p-0 mt-4">
        <div class="p-4 border-bottom">
            <h5 class="mb-1">Recent Shipments</h5>
            <p class="text-muted mb-0">Latest shipment activity for this client.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Tracking</th>
                        <th>Receiver</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Delivery Fee</th>
                        <th>COD</th>
                        <th>Payment</th>
                        <th>Created</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recent_shipments as $shipment)
                        <tr>
                            <td>
                                <strong>{{ $shipment->tracking_number }}</strong>
                            </td>

                            <td>{{ $shipment->receiver_name }}</td>

                            <td>{{ $shipment->receiver_city }}</td>

                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                    {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                                </span>
                            </td>

                            <td>
                                <strong>${{ number_format($shipment->delivery_fee, 2) }}</strong>
                            </td>

                            <td>
                                <strong>${{ number_format($shipment->cod_amount, 2) }}</strong>
                            </td>

                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                    {{ ucfirst($shipment->payment_status) }}
                                </span>
                            </td>

                            <td>{{ $shipment->created_at?->format('d M Y') }}</td>

                            <td class="text-end">
                                <a href="{{ route('shipments.show', $shipment) }}"
                                class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                No recent shipments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection