<div class="card-box p-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0" id="mainTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($branches as $branch)
                    <tr>
                        <td><strong>{{ $branch->id }}</strong></td>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->city }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>{{ $branch->phone }}</td>
                        <td>
                            @if($branch->is_active)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td>{{ $branch->created_at->format('d M Y') }}</td>

                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">

                                @can('view', $branch)
                                    <a href="{{ route('branches.show', $branch) }}"
                                        class="btn btn-sm btn-outline-info view-btn">
                                            <i class="bi bi-eye"></i>
                                    </a>
                                @endcan

                                @can('update', $branch)
                                    <button class="btn btn-sm btn-outline-primary edit-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal"
                                            data-id="{{ $branch->id }}"
                                            data-name="{{ $branch->name }}"
                                            data-phone="{{ $branch->phone }}"
                                            data-city="{{ $branch->city }}"
                                            data-address="{{ $branch->address }}"
                                            data-status="{{ $branch->is_active }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                @endcan

                                @can('deactivate', $branch)
                                    @if($branch->is_active)
                                        <form action="{{ route('branches.deactivate', $branch) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-danger status-btn">
                                                Deactivate
                                            </button>
                                        </form>
                                    @endif
                                @endcan

                                @can('activate', $branch)
                                    @if(! $branch->is_active)
                                        <form action="{{ route('branches.activate', $branch) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success status-btn">
                                                Activate
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                                
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div>
                                <i class="bi bi-buildings fs-1 d-block mb-2 text-muted"></i>
                                <div class="fw-semibold">No branches found.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>