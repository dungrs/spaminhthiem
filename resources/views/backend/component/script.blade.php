<script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/libs/feather-icons/feather.min.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector map-->
<script src="{{ asset('backend/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('backend/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!-- swiper js -->
<script src="{{ asset('backend/libs/swiper/swiper-bundle.min.js') }}"></script>

{{-- jQuery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Plugin js defaualt -->
<script src="{{ asset('backend/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('backend/libs/alertifyjs/build/alertify.min.js') }}"></script>
<script src="{{ asset('backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('backend/js/app.js') }}"></script>
@php
    $snakeModel = toSnakeCase($configs['model'] ?? '');
    $modalTitle = __("messages.$snakeModel.modal.title")
@endphp
<script>
    const Config = {
        model: "{{ $configs['model'] ?? '' }}",
        modelParent: "{{ $configs['modelParent'] ?? '' }}",
        confirmMessages: {!! json_encode(__('messages.confirmJs')) !!},
        albumMessages: {!! json_encode(__('messages.album')) !!},
        actionTextButton: {!! json_encode(__('messages.actions')) !!},
        seoDefaultMessage: {!! json_encode(__('messages.seo_default')) !!},
        translations: {!! json_encode(__('messages.translations')) !!},
        modalTitle: {!! json_encode($modalTitle) !!},
        baseUrl: "{{ url('/') }}",
    };
</script>

@if (isset($configs['js']) && is_array($configs['js']))
    @foreach ($configs['js'] as $item)
        <script src="{{ asset($item) }}"></script>
    @endforeach
@endif