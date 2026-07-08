document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.edit-role-btn').forEach(button => {
        button.addEventListener('click', function () {
            const roleId = this.dataset.id;
            const roleName = this.dataset.name;
            const permissions = JSON.parse(this.dataset.permissions || '[]');

            document.getElementById('editRoleForm').action = `/roles/${roleId}`;
            document.getElementById('editRoleName').value = roleName;

            document.querySelectorAll('.edit-permission').forEach(input => {
                input.checked = permissions.includes(Number(input.value));
            });
        });
    });

    document.querySelectorAll('.delete-role-btn').forEach(button => {
        button.addEventListener('click', function () {
            const roleId = this.dataset.id;
            const roleName = this.dataset.name;

            document.getElementById('deleteRoleName').textContent = roleName;
            document.getElementById('deleteRoleForm').action = `/roles/${roleId}`;
        });
    });

    
});