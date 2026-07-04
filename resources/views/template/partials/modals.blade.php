<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Shipment</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" placeholder="Enter customer name">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter phone number">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Branch</label>
                        <select class="form-select">
                            <option>Beirut</option>
                            <option>Saida</option>
                            <option>Tripoli</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" placeholder="0.00">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" rows="3" placeholder="Enter address"></textarea>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" onclick="showToast('Created successfully')">
                    Save
                </button>
            </div>

        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Shipment Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <small class="text-muted">Tracking</small>
                        <div class="fw-bold" id="viewTracking">-</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Customer</small>
                        <div class="fw-bold" id="viewCustomer">-</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Phone</small>
                        <div id="viewPhone">-</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Branch</small>
                        <div id="viewBranch">-</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Status</small>
                        <div id="viewStatus">-</div>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Amount</small>
                        <div id="viewAmount">-</div>
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
                <h5 class="modal-title">Edit Shipment</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Tracking</label>
                        <input type="text" class="form-control" id="editTracking">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Customer</label>
                        <input type="text" class="form-control" id="editCustomer">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="editPhone">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Branch</label>
                        <select class="form-select" id="editBranch">
                            <option>Beirut</option>
                            <option>Saida</option>
                            <option>Tripoli</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="editStatus">
                            <option>Pending</option>
                            <option>Collected</option>
                            <option>In Transit</option>
                            <option>Delivered</option>
                            <option>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" id="editAmount">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" onclick="showToast('Updated successfully')">
                    Update
                </button>
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
                Are you sure you want to delete this record?
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
