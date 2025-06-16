<div class="row mb-2 filter-data">
    <div class="col-sm-12">
        <div class="d-flex gap-3">
            @include('backend.component.perpage')
            @foreach (__('cart') as $key => $val)
                <div class="mb-3">
                    <select name="{{ $key }}" class="form-control rounded choice-single" id="{{ $key }}">
                        @foreach ($val['data'] as $index => $item)
                            <option value="{{ $index }}">
                                {{ $item }}
                            </option>
                        @endforeach
                    </select> 
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-4">
        
    </div><!-- end col-->
</div>