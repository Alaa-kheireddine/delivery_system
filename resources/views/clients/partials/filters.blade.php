<form action="{{ route('clients.index') }}" method="GET" id="formFilter">
    <div class="card-box p-3 mb-4">
        <div class="row g-3">
            
            <!-- Search by name, code -->
            <div class="col-12 col-md-4 col-lg-4">
                <label class="filter-label">Search</label>
                <input type="text" 
                    id="searchInputFilter" 
                    name="search" 
                    class="form-control" 
                    value="{{ request('search') }}"
                    placeholder="Search by code or name ."
                >
            </div>

            <!-- search by branch tbayen bass lal admin, manager m fi yfatech b 8er fer3o-->
            @if (auth()->user()->role->name === 'admin')
                <div class="col-6 col-md-4 col-lg-2">
                    <label class="filter-label">Branch</label>
                    <select id="branchFilter" name="branch_name" class="form-select">
                        <option value="">All Branches</option>
                        @foreach($branches as $branch)
                            <option
                                value="{{ $branch->name }}"
                                @selected(request('branch_name') == $branch->name)
                            >
                                {{ Str::headline($branch->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- search by status -->
            <div class="col-6 col-md-4 col-lg-2">
                <label class="filter-label">Status</label>
                <select id="statusFilter" name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" @selected(request('status') == 'active')>Active</option>
                    <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                </select>
            </div>

            <!-- Search, Clear filters -->
            <div class="col-12 col-md-4 col-lg-4 d-flex justify-content-center align-items-center">
                <div class="d-flex gap-3 w-100">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-search"></i>
                    </button>

                    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary flex-fill">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('formFilter').addEventListener('submit', function () {
        this.querySelectorAll('input, select').forEach(function (field) {
            if (field.value === '') {
                field.disabled = true;
            }
        });
    });
</script>