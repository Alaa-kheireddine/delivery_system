<div class="card-box p-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0" id="mainTable">
            <thead>
            <tr>
                <th>
                    <input type="checkbox" class="form-check-input" id="checkAll">
                </th>
                <th>#</th>
                <th>Tracking</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Branch</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Date</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>

            <tbody>
            <tr data-status="Pending" data-branch="Beirut">
                <td><input type="checkbox" class="form-check-input row-check"></td>
                <td>1</td>
                <td><strong>TRK-1001</strong></td>
                <td>Ali Ahmad</td>
                <td>03 111 222</td>
                <td>Beirut</td>
                <td><span class="badge badge-soft-warning">Pending</span></td>
                <td>$25.00</td>
                <td>2026-07-01</td>
                <td class="text-end">
                    <button class="btn btn-light btn-sm action-btn view-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#viewModal"
                            data-tracking="TRK-1001"
                            data-customer="Ali Ahmad"
                            data-phone="03 111 222"
                            data-branch="Beirut"
                            data-status="Pending"
                            data-amount="$25.00">
                        <i class="bi bi-eye"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn text-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>

            <tr data-status="Delivered" data-branch="Saida">
                <td><input type="checkbox" class="form-check-input row-check"></td>
                <td>2</td>
                <td><strong>TRK-1002</strong></td>
                <td>Hassan Khaled</td>
                <td>70 555 888</td>
                <td>Saida</td>
                <td><span class="badge badge-soft-success">Delivered</span></td>
                <td>$40.00</td>
                <td>2026-07-01</td>
                <td class="text-end">
                    <button class="btn btn-light btn-sm action-btn view-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#viewModal"
                            data-tracking="TRK-1001"
                            data-customer="Ali Ahmad"
                            data-phone="03 111 222"
                            data-branch="Beirut"
                            data-status="Pending"
                            data-amount="$25.00">
                        <i class="bi bi-eye"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn text-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>

            <tr data-status="In Transit" data-branch="Tripoli">
                <td><input type="checkbox" class="form-check-input row-check"></td>
                <td>3</td>
                <td><strong>TRK-1003</strong></td>
                <td>Omar Saleh</td>
                <td>81 333 444</td>
                <td>Tripoli</td>
                <td><span class="badge badge-soft-info">In Transit</span></td>
                <td>$18.00</td>
                <td>2026-06-30</td>
                <td class="text-end">
                    <button class="btn btn-light btn-sm action-btn view-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#viewModal"
                            data-tracking="TRK-1001"
                            data-customer="Ali Ahmad"
                            data-phone="03 111 222"
                            data-branch="Beirut"
                            data-status="Pending"
                            data-amount="$25.00">
                        <i class="bi bi-eye"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn text-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>

            <tr data-status="Cancelled" data-branch="Beirut">
                <td><input type="checkbox" class="form-check-input row-check"></td>
                <td>4</td>
                <td><strong>TRK-1004</strong></td>
                <td>Maya Nader</td>
                <td>76 999 000</td>
                <td>Beirut</td>
                <td><span class="badge badge-soft-danger">Cancelled</span></td>
                <td>$33.00</td>
                <td>2026-06-29</td>
                <td class="text-end">
                    <button class="btn btn-light btn-sm action-btn view-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#viewModal"
                            data-tracking="TRK-1001"
                            data-customer="Ali Ahmad"
                            data-phone="03 111 222"
                            data-branch="Beirut"
                            data-status="Pending"
                            data-amount="$25.00">
                        <i class="bi bi-eye"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn btn-light btn-sm action-btn text-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="empty-state" id="emptyState">
        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
        No records found.
    </div>

    <!-- Pagination -->
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Showing {{ $branches->firstItem() ?? 0 }}
            to {{ $branches->lastItem() ?? 0 }}
            of {{ $branches->total() }} results
        </small>

        <div class="pagination-wrapper">
            {{ $branches->links() }}
        </div>
    </div>
</div>