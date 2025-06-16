<div class="row mb-2 filter-data">
    <div class="col-md-9">
        <div class="d-flex gap-3">
            @include('backend.component.perpage')
            @include('backend.component.publish')
            {{-- <div class="mb-3">
                <select class="form-control rounded choice-single" name="customer_catalogue_filter">
                    <option value="">{{ $seoTables['filter_customer'] }}</option>
                    @foreach ($customerCatalogues as $customerCatalogue)
                        <option value="{{ $customerCatalogue->id }}">{{ $customerCatalogue->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            @include('backend.component.keyword')
        </div>
    </div>
    <div class="col-md-3">

    </div><!-- end col-->
</div>