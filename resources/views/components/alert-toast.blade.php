@if (session('success') || session('error') || $errors->any())
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="alertToast"
             class="toast align-items-center border-0 text-white
             {{ session('success') ? 'bg-success' : 'bg-danger' }}"
             role="alert">

            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') ?? session('error') ?? $errors->first() }}
                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.getElementById('alertToast');

            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement, {
                    delay: 3000
                });

                toast.show();
            }
        });
    </script>
@endif