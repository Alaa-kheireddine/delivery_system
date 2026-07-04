<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Branch</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('branches.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Branch Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter branch name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter branch city" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter branch address">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                        </div>

                    </div>

                    <div class="modal-footer mt-3">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">Branch Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Top Summary --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-building fs-4"></i>
                        </div>

                        <div>
                            <h5 class="mb-1" id="viewName">-</h5>
                            <small class="text-muted">
                                Branch ID: <span id="viewID">-</span>
                            </small>
                        </div>
                    </div>

                    <span class="badge rounded-pill px-3 py-2" id="viewStatusBadge">
                        -
                    </span>
                </div>

                {{-- Info Cards --}}
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-geo-alt me-1"></i> City
                            </small>
                            <div class="fw-semibold" id="viewCity">-</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-telephone me-1"></i> Phone
                            </small>
                            <div class="fw-semibold" id="viewPhone">-</div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="border rounded-3 p-3 h-100">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-map me-1"></i> Address
                            </small>
                            <div class="fw-semibold" id="viewAddress">-</div>
                        </div>
                    </div>

                </div>

                {{-- Quick Stats --}}
                <div class="row g-3 mt-2">

                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <small class="text-muted d-block">Users</small>
                            <div class="fw-bold fs-5" id="viewUsersCount">0</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <small class="text-muted d-block">Shipments</small>
                            <div class="fw-bold fs-5" id="viewShipmentsCount">0</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <small class="text-muted d-block">Active Shipments</small>
                            <div class="fw-bold fs-5" id="viewActiveShipmentsCount">0</div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Branch</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <form action="#" id="editForm" method="POST" class="form form-control">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="editName" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" id="editCity" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="editAddress">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="editPhone">
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Confirmation</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this Branch?
                <div class="fw-bold mt-2" id="deleteItemName">-</div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" onclick="showToast('Deleted successfully')">
                    Delete
                </button>
            </div>

        </div>
    </div>
</div>
