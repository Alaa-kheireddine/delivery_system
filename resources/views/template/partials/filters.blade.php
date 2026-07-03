<div class="card-box p-3 mb-4">
    <div class="row g-3">

        <div class="col-md-3">
            <label class="filter-label">Search</label>
            <input type="text" id="searchInput" class="form-control" placeholder="Search shipment, customer...">
        </div>

        <div class="col-md-2">
            <label class="filter-label">Status</label>
            <select id="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="Pending">Pending</option>
                <option value="Collected">Collected</option>
                <option value="In Transit">In Transit</option>
                <option value="Delivered">Delivered</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div class="col-md-2">
            <label class="filter-label">Branch</label>
            <select id="branchFilter" class="form-select">
                <option value="">All Branches</option>
                <option value="Beirut">Beirut</option>
                <option value="Saida">Saida</option>
                <option value="Tripoli">Tripoli</option>
            </select>
        </div>

        <div class="col-md-2">
            <label class="filter-label">From Date</label>
            <input type="date" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="filter-label">To Date</label>
            <input type="date" class="form-control">
        </div>

        <div class="col-md-1 d-flex align-items-end">
            <button id="resetFilters" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle"></i>
            </button>
        </div>

    </div>
</div>