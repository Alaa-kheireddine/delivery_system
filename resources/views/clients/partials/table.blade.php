<div class="card-box p-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0" id="mainTable">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Total Earnings</th>
                    <th>Current Balance</th>
                    <th>Total Paid Amount</th>
                    <th>Default Delivery Fee</th>
                    <th>Phone</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td><strong>{{ $client->code }}</strong></td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->total_client_earnings }}</td>
                        <td>{{ $client->current_balance }}</td>
                        <td>{{ $client->total_paid_amount }}</td>
                        <td>{{ $client->default_delivery_fee }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->branch->name ?? '-' }}</td>

                        <td>
                            @if($client->is_active)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">

                                @can('view', $client)
                                    <a href="{{ route('clients.show', $client) }}"
                                        class="btn btn-sm btn-outline-info view-btn">
                                            <i class="bi bi-eye"></i>
                                    </a>
                                @endcan
                                                                
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-5">
                            <div>
                                <i class="bi bi-buildings fs-1 d-block mb-2 text-muted"></i>
                                <div class="fw-semibold">No clients found.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>