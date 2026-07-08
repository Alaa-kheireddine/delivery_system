document.addEventListener('DOMContentLoaded', function(){

    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('viewID').innerText = this.dataset.id;
            document.getElementById('viewName').innerText = this.dataset.name;
            document.getElementById('viewCity').innerText = this.dataset.city;
            document.getElementById('viewAddress').innerText = this.dataset.address;
            document.getElementById('viewStatus').innerText = this.dataset.status ? 'Active' : 'Inactive';
            document.getElementById('viewPhone').innerText = this.dataset.phone;
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            let id = this.dataset.id;

            document.getElementById('editName').value = this.dataset.name;
            document.getElementById('editCity').value = this.dataset.city;
            document.getElementById('editAddress').value = this.dataset.address;
            document.getElementById('editPhone').value = this.dataset.phone;

            document.getElementById("editForm").action = '/branches/'+ id;
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('deleteItemName').innerText = this.dataset.name;
        });
    });
});

