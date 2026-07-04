@if (session('success') || session('error') || $errors->any())

@php
    $type = session('success') ? 'success' : 'danger';

    $message = session('success')
        ?? session('error')
        ?? null;
@endphp

<div class="toast-container custom-toast-container">
    <div id="alertToast"
         class="toast custom-toast custom-toast-{{ $type }}"
         role="alert"
         aria-live="assertive"
         aria-atomic="true"
         data-bs-delay="3500">

        <div class="toast-content">
            <div class="toast-icon">
                <i class="bi {{ $type === 'success' ? 'bi-check-lg' : 'bi-exclamation-lg' }}"></i>
            </div>

            <div class="toast-message">
                <strong>{{ $type === 'success' ? 'Success' : 'Error' }}</strong>

                @if ($message)
                    <p>{{ $message }}</p>
                @elseif ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <button type="button"
                    class="toast-close"
                    data-bs-dismiss="toast"
                    aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="toast-progress"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElement = document.getElementById('alertToast');

        if (toastElement) {
            const toast = new bootstrap.Toast(toastElement, {
                delay: 3500
            });

            toast.show();
        }
    });
</script>
@endif