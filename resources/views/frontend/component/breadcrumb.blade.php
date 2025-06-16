<nav aria-label="breadcrumb mb-2">
    <ol class="breadcrumb mb-0">
        <li class=" d-flex align-items-center">
            <a href="#" class="text-decoration-none text-muted">@lang('frontend.home')</a>
            <i class="fas fa-chevron-right mx-2 text-muted mt-1" style="font-size: 0.75rem;"></i>
        </li>
        @if(!is_null($breadcrumb))
            @foreach ($breadcrumb as $item)
                @if ($item->canonical == $model->canonical)
                    @continue
                @endif
                @php
                    $name = $item->name;
                    $canonical = writeUrl($item->canonical, true, true)
                @endphp
                <li class=" d-flex align-items-center">
                    <a href="{{ $canonical }}" class="text-decoration-none text-muted">{{ $name }}</a>
                    <i class="fas fa-chevron-right mx-2 text-muted mt-1" style="font-size: 0.75rem;"></i>
                </li>
            @endforeach
        @endif

        <li class=" active text-danger fw-medium" aria-current="page">
            {{ $model->name }}
        </li>
    </ol>
</nav>