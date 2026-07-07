document.addEventListener('DOMContentLoaded', function(){

    const viewButtons = document.querySelectorAll('.view-btn');

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {

        const user = JSON.parse(this.dataset.user);

        document.getElementById('viewID').textContent = user.id || '-';
        document.getElementById('viewName').textContent = user.name || '-';
        document.getElementById('viewEmail').textContent = user.email || '-';
        document.getElementById('viewPhone').textContent = user.phone || '-';
        document.getElementById('viewRole').textContent = user.role?.name || '-';
        document.getElementById('viewBranch').textContent = user.branch?.name || '-';
        document.getElementById('viewSalary').textContent = user.salary || '-';

        const clientSection = document.getElementById('viewClientSection');

        if (user.role?.name === 'client') {

            clientSection.classList.remove('d-none');
            document.getElementById('viewSalarySection').classList.add('d-none');

            document.getElementById('viewClientName').textContent = user.client?.name || '-';
            document.getElementById('viewClientCode').textContent = user.client?.client_code || '-';
            document.getElementById('viewClientPhone').textContent = user.client?.phone || '-';
            document.getElementById('viewClientCity').textContent = user.client?.city || '-';
            document.getElementById('viewClientAddress').textContent = user.client?.address || '-';
            document.getElementById('viewClientDeliveryFee').textContent = user.client?.delivery_fee || '0.00';
            document.getElementById('viewClientContactPerson').textContent = user.client?.contact_person || '-';
            document.getElementById('viewClientNotes').textContent = user.client?.notes || '-';
            document.getElementById('viewClientEmail').textContent = user.client?.email || '-';

        } else {
            clientSection.classList.add('d-none');
            document.getElementById('viewSalarySection').classList.remove('d-none');
        }
        })
    });

    // (Create User Modal) Logic la tfta7 clients Section
    document.getElementById('createUserRole').addEventListener('change', function () {
        toggleClientFields('createUserRole', 'createClientFields', 'createSaveBtn');
    });

    // Logic lal view user & client

    // Logic lal edit user & client

    let selectedUserId = null;
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            const user = JSON.parse(this.dataset.user);
            selectedUserId = user.id;

            const form = document.getElementById('editUserForm');

            form.action = `/users/${user.id}`;

            document.getElementById('editUserID').textContent = user.id ?? '-';
            document.getElementById('editTopName').textContent = user.name ?? 'Edit User';

            document.getElementById('editName').value = user.name ?? '';
            document.getElementById('editEmail').value = user.email ?? '';
            document.getElementById('editPhone').value = user.phone ?? '';
            document.getElementById('editSalary').value = user.salary ?? '';

            document.getElementById('editBranchID').value = user.branch_id ?? '';

            document.getElementById('editUserRole').value = user.role_id ?? '';

            const roleName = user.role?.name ?? '';

            const salarySection = document.getElementById('editSalarySection');
            const roleSection = document.getElementById('editUserRoleSection');

            if (roleName === 'client') {
                salarySection.classList.add('d-none');
                roleSection.classList.add('d-none');
            } else {
                salarySection.classList.remove('d-none');
                roleSection.classList.remove('d-none');
            }

            const clientSection = document.getElementById('editClientFields');

            if (roleName === 'client' && user.client) {
                clientSection.classList.remove('d-none');

                
                document.getElementById('editClientCode').value = user.client.code ?? '';
                document.getElementById('editClientName').value = user.client.name ?? '';
                document.getElementById('editClientContactPerson').value = user.client.contact_person_name ?? '';
                document.getElementById('editClientPhone').value = user.client.phone ?? '';
                document.getElementById('editClientDeliveryFee').value = user.client.default_delivery_fee ?? '';
                document.getElementById('editClientEmail').value = user.client.email ?? '';
                document.getElementById('editClientAddress').value = user.client.address ?? '';
                document.getElementById('editClientCity').value = user.client.city ?? '';
                document.getElementById('editClientBranchId').value = user.client.branch_id ?? '';
                document.getElementById('editClientNotes').value = user.client.notes ?? '';
            } else {
                clientSection.classList.add('d-none');

                document.getElementById('editClientCode').value = '';
                document.getElementById('editClientName').value = '';
                document.getElementById('editClientContactPerson').value = '';
                document.getElementById('editClientPhone').value = '';
                document.getElementById('editClientDeliveryFee').value = '';
                document.getElementById('editClientEmail').value = '';
                document.getElementById('editClientAddress').value = '';
                document.getElementById('editClientCity').value = '';
                document.getElementById('editClientNotes').value = '';
            }
        });
    });

    // Reset Password 
    document.getElementById('resetPasswordButton').addEventListener('click', async function () {
        if (!selectedUserId) return;

        const result = await Swal.fire({
            title: 'Reset password?',
            text: 'A new temporary password will be generated.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reset it',
            cancelButtonText: 'Cancel',
        });

        if (!result.isConfirmed) return;

        const response = await fetch(`/users/${selectedUserId}/reset-password`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        });

        const data = await response.json();

        if (result.isConfirmed) {
            Swal.fire({
                title: 'Password Reset Successfully',
                html: `
                    <div class="text-start">
                        <strong>Temporary Password:</strong>
                        <div class="input-group">
                            <input
                                type="text"
                                id="tempPassword"
                                class="form-control"
                                value="${data.temporary_password}"
                                readonly
                            >
                            <button
                                class="btn btn-outline-primary"
                                type="button"
                                onclick="copyTempPassword(this)"
                                id="copyPasswordBtn"
                            >
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                    </div>
                `,
                icon: 'success',
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: data.message || 'Something went wrong',
                icon: 'error',
            });
        }
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('deleteItemName').innerText = this.dataset.name;
        });
    });

});

async function copyTempPassword(button) {
    const password = document.getElementById('tempPassword').value;

    await navigator.clipboard.writeText(password);

    button.className = 'btn btn-success';
    button.innerHTML = `<i class="bi bi-check-lg me-1"></i>Copied`;

    setTimeout(() => {
        button.className = 'btn btn-outline-primary';
        button.innerHTML = `<i class="bi bi-copy"></i>`;
    }, 1500);
}

function toggleClientFields(roleSelectId, clientFieldsId, saveBtnId) {
    const roleSelect = document.getElementById(roleSelectId);
    const clientFields = document.getElementById(clientFieldsId);
    const saveBtn = document.getElementById(saveBtnId);
    

    if (!roleSelect || !clientFields || !saveBtn) return;

    const selectedOption = roleSelect.options[roleSelect.selectedIndex];
    const roleName = selectedOption.dataset.optionRoleName;

    const clientInputs = clientFields.querySelectorAll('input, select, textarea');

    if (roleName === 'client') {
        clientFields.classList.remove('d-none');
        saveBtn.innerHTML = 'Save User & Client';

        clientInputs.forEach(input => {
            input.disabled = false;
        });
    } else {
        clientFields.classList.add('d-none');
        saveBtn.innerHTML = 'Save User';

        clientInputs.forEach(input => {
            input.disabled = true;
        });
    }
}