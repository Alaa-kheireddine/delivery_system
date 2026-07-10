<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Client</h5>
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
                                <label class="form-label text-muted small">
                                    <i class="bi bi-buildings me-1"></i> Branch
                                </label>
                                <select name="branch_id" id="editBranchID" class="form-select">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->city }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label class="form-label">Default Delivery Fee</label>
                                <input type="text" name="default_delivery_fee" class="form-control" id="editDeliveryFee" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Contact Person</label>
                                <input type="text" name="contact_person_name" class="form-control" id="editContactPerson">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="editClientEmail" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="editClientPhone">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" id="editClientCity" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="editClientAddress">
                            </div>

                        </div>

                        <div class="row g-3 mt-2">

                            <div class="col-md-12">
                                <div class="border rounded-3 p-3 h-100">
                                    <label class="form-label text-muted small">
                                        <i class="bi bi-cash-card-text me-1"></i> Notes
                                    </label>
                                    <textarea name="client_notes" id="editClientNotes" class="form-control" rows="6"></textarea>
                                </div>
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
                Are you sure you want to delete this Client?
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