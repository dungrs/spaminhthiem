<div class="d-flex justify-content-end pt-1">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-vertical font-size-20"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
            @foreach (__('messages.publish') as $key => $val)
                @if ($key != "")
                    <li><a class="dropdown-item changeStatusAll" data-field="publish" data-value="{{ $key }}" data-field="publish" href="#">{{ $val }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>