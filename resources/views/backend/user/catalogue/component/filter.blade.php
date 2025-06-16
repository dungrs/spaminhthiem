<div class="row mb-2 filter-data">
    <div class="col-sm-8">
        <div class="d-flex gap-3">
            @if (!isset($permission))
                @include('backend.component.perpage')
                @include('backend.component.publish')
                @include('backend.component.keyword')
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        
    </div><!-- end col-->
</div>