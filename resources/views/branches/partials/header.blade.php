<div class="page-header mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h4 class="mb-1">Branches Management</h4>
            <p class="text-muted mb-0"> Centralized management for branch information, operations, and shipment activity.</p>
        </div>
        
        @can('create', App\Models\Branch::class)
            <div class="d-flex flex-wrap gap-2">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#createModal"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Add Branch
                </button>
            </div>
        @endcan
    </div>
</div>
