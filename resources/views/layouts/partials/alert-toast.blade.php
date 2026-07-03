@if (session('success') || session('error') || $errors->any())
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="alertToast"
             class="toast align-items-center border-0 text-white
             {{ session('success') ? 'bg-success' : 'bg-danger' }}"
             role="alert">

            <div class="d-flex">
                <div class="toast-body">

                    @if (session('success'))
                        {{ session('success') }}

                    @elseif (session('error'))
                        {{ session('error') }}

                    @elseif ($errors->any())
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.getElementById('alertToast');

            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement, {
                    delay: 5000
                });

                toast.show();
            }
        });
    </script>
@endif