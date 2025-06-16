<div class="row mb-2 filter-data">
    <div class="col-lg-12">
        <div class="d-flex gap-3">
            @include('backend.component.perpage')
            @include('backend.component.publish')
            @include('backend.component.keyword')
            {{-- <div class="mb-3">
                <select class="form-control rounded choice-single" name="post_catalogue_id" style="min-width: 200px;">
                    @foreach ($dropdown as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>
    </div>
</div>