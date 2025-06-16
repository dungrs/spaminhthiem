<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="card-title">
            {{ $seoTables['title'] }}
        </div>  
        <div class="d-flex gap-1 justify-content-end">
            <div class="text-sm-end">
                <a href="{{ route('menu.create') }}" class="btn btn-success waves-effect waves-light add-button">
                    <i class="mdi mdi-plus me-1"></i> {{ $seoTables['add_button'] }}
                </a>
            </div>
            @include('backend.component.toolbox')
        </div>
    </div>
</div>