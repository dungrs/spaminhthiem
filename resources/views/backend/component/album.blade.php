<div class="card shadow-sm">
    <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-img-collapse">
        <div class="p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                            @isset($index)
                                {!! $index !!}
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">{{ __('messages.album.album_title') }}</h5>
                    <p class="text-muted text-truncate mb-0">{{ __('messages.album.album_description') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </div>
    </a>

    @php
        $gallery = isset($album) && count($album) ? $album : []
    @endphp

    <div id="addproduct-img-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
        <div class="p-4 border-top rounded-3">
            @if (!isset($gallery) || count($gallery) == 0)
                <div class="click-to-upload">
                    <div class="icon">
                        <a href="#" class="upload-picture" data-name="album[]">
                            <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                        </a>
                    </div>
                    <h5 class="mt-2">{{ __('messages.album.upload_placeholder') }}</h5>
                </div>
            @endif
    
            <div class="upload-list upload-picture {{ (isset($gallery) && count($gallery)) ? '' : 'hidden' }}" data-name="album[]">
                <ul id="sortable" class="clearfix data-album sortui ui-sortable">
                    @if (isset($gallery) && count($gallery))
                        @foreach ($gallery as $val)
                            <li class="ui-state-default">
                                <div class="thumb">
                                    <span class="span image img-scaledown">
                                        <img src="{{ $val }}" alt="{{ $val }}">
                                        <input type="hidden" name="album[]" value="{{ $val }}">
                                    </span>
                                    <button type="button" class="delete-image"><i class="fa fa-trash"></i></button>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>