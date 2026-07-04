<div class="page-header mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h4 class="mb-1">Users Management</h4>
            <p class="text-muted mb-0"> Centralized management for users information and activity.</p>
        </div>
        
        @can('create', App\Models\User::class)
            <div class="d-flex flex-wrap gap-2">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#createModal"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Create User
                </button>
            </div>
        @endcan
    </div>
</div>
