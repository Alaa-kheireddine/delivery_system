document.addEventListener('DOMContentLoaded', function(){
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const branchFilter = document.getElementById('branchFilter');
    const resetFilters = document.getElementById('resetFilters');
    const table = document.getElementById('mainTable');
    const rows = table.querySelectorAll('tbody tr');
    const emptyState = document.getElementById('emptyState');

    const checkAll = document.getElementById('checkAll');
    const rowChecks = document.querySelectorAll('.row-check');
    const selectedCount = document.getElementById('selectedCount');

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const branchValue = branchFilter.value;

        let visibleCount = 0;

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const rowStatus = row.dataset.status;
            const rowBranch = row.dataset.branch;

            const matchSearch = rowText.includes(searchValue);
            const matchStatus = !statusValue || rowStatus === statusValue;
            const matchBranch = !branchValue || rowBranch === branchValue;

            if (matchSearch && matchStatus && matchBranch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
    branchFilter.addEventListener('change', filterTable);

    resetFilters.addEventListener('click', function () {
        searchInput.value = '';
        statusFilter.value = '';
        branchFilter.value = '';
        filterTable();
    });

    checkAll.addEventListener('change', function () {
        rowChecks.forEach(check => {
            check.checked = checkAll.checked;
        });

        updateSelectedCount();
    });

    rowChecks.forEach(check => {
        check.addEventListener('change', updateSelectedCount);
    });

    function updateSelectedCount() {
        const count = document.querySelectorAll('.row-check:checked').length;
        selectedCount.innerText = count;
    }

    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('viewTracking').innerText = this.dataset.tracking;
            document.getElementById('viewCustomer').innerText = this.dataset.customer;
            document.getElementById('viewPhone').innerText = this.dataset.phone;
            document.getElementById('viewBranch').innerText = this.dataset.branch;
            document.getElementById('viewStatus').innerText = this.dataset.status;
            document.getElementById('viewAmount').innerText = this.dataset.amount;
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const cells = row.querySelectorAll('td');

            document.getElementById('editTracking').value = cells[2].innerText;
            document.getElementById('editCustomer').value = cells[3].innerText;
            document.getElementById('editPhone').value = cells[4].innerText;
            document.getElementById('editBranch').value = cells[5].innerText;
            document.getElementById('editStatus').value = row.dataset.status;
            document.getElementById('editAmount').value = cells[7].innerText;
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const tracking = row.querySelectorAll('td')[2].innerText;

            document.getElementById('deleteItemName').innerText = tracking;
        });
    });

    function showToast(message) {
        document.getElementById('toastMessage').innerText = message;

        const toastElement = document.getElementById('mainToast');
        const toast = new bootstrap.Toast(toastElement);

        toast.show();
    }

});
