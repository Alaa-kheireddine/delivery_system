<form action="{{ route('users.index') }}" method="GET" id="formFilter">
    <div class="card-box p-3 mb-4">
        <div class="row g-3">
            
            <!-- Search by name, email -->
            <div class="col-12 col-md-4 col-lg-4">
                <label class="filter-label">Search</label>
                <input type="text" 
                    id="searchInputFilter" 
                    name="search" 
                    class="form-control" 
                    value="{{ request('search') }}"
                    placeholder="Search by name, email or phone..."
                >
            </div>

            <!-- search by role -->
            <div class="col-6 col-md-4 col-lg-2">
                <label class="filter-label">Role</label>
                <select id="roleFilter" name="role_name" class="form-select">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        <option
                            value="{{ $role->name }}"
                            @selected(request('role_name') == $role->name)
                        >
                            {{ Str::headline($role->name) }}
                        </option>
                    @endforeach
                </select>
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

            <!-- search by password status -->
            <div class="col-6 col-md-4 col-lg-2">
                <label class="filter-label">Password</label>
                <select name="password_status" id="passwordStatusFilter" class="form-select">
                    <option value="">All Password Status</option>
                    <option value="must_change" @selected(request('password_status') == 'must_change')>Must Change</option>
                    <option value="changed" @selected(request('password_status') == 'changed')>Changed</option>
                    <option value="not_changed" @selected(request('password_status') == 'not_changed')>Not Changed</option>
                </select>
            </div>

            <!-- Search, Clear filters -->
            <div class="col-12 col-md-4 col-lg-4 d-flex justify-content-center align-items-center">
                <div class="d-flex gap-3 w-100">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-search"></i>
                    </button>

                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary flex-fill">
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