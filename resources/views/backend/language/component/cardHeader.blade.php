<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="card-title">
            {{ $seoTables['title'] }}
        </div>  
        <div class="d-flex gap-1 justify-content-end">
            <div class="text-sm-end">
                <button type="button" class="btn btn-success waves-effect waves-light me-2 add-button"><i class="mdi mdi-plus me-1"></i> {{ $seoTables['add_button'] }}</button>
            </div>
            @include('backend.component.toolbox')
        </div>
    </div>
</div>