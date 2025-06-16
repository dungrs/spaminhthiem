<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="card-title">
            {{ $seoTables['title'] }}
        </div>  
        <div class="d-flex gap-1 justify-content-end">
            @if (!isset($permission))
                <div class="text-sm-end me-1">
                    <a href="{{ route('user.catalogue.permission') }}" class="btn btn-primary waves-effect waves-light permission-button">
                        <i class="mdi mdi-security me-1"></i> {{ __('messages.assign_permission') }}
                    </a>
                </div>
                <div class="text-sm-end">
                    <button type="button" class="btn btn-success waves-effect waves-light add-button"><i class="mdi mdi-plus me-1"></i> {{ $seoTables['add_button'] }}</button>
                </div>
                @include('backend.component.toolbox')
            @endif
        </div>
    </div>
</div>