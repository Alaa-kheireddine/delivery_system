<nav aria-label="breadcrumb" class="mb-4 ms-1">
    <ol class="breadcrumb mb-0 align-items-center">
        @foreach($items as $item)
            @if(!empty($item['active']))
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    {{ $item['label'] }}
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}" class="text-decoration-none text-muted">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>