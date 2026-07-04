document.addEventListener('DOMContentLoaded', function(){

    // document.querySelectorAll('.view-btn').forEach(button => {
    //     button.addEventListener('click', function () {

    //         document.getElementById('viewID').innerText = this.dataset.id;
    //         document.getElementById('viewName').innerText = this.dataset.name;
    //         document.getElementById('viewCity').innerText = this.dataset.city;
    //         document.getElementById('viewAddress').innerText = this.dataset.address;
    //         document.getElementById('viewStatus').innerText = this.dataset.status ? 'Active' : 'Inactive';
    //         document.getElementById('viewPhone').innerText = this.dataset.phone;
    //     });
    // });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            let id = this.dataset.id;

            document.getElementById('editName').value = this.dataset.name || '';
            document.getElementById('editEmail').value = this.dataset.email || '';
            document.getElementById('editPhone').value = this.dataset.phone || '';
            document.getElementById('editSalary').value = this.dataset.salary || '';

            document.getElementById('editRole').value = this.dataset.roleId || '';
            document.getElementById('editBranch').value = this.dataset.branchId || '';

            console.log(this.dataset, "document.getElementById('editBranch').value  :"+document.getElementById('editBranch').value,"document.getElementById('editRole').value  :" +document.getElementById('editRole').value );

            document.getElementById("editForm").action = '/users/'+ id;
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('deleteItemName').innerText = this.dataset.name;
        });
    });
});

