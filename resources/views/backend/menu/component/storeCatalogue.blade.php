<div class="modal fade store-catalogue-modal" id="menuPositionModal" tabindex="-1" aria-labelledby="menuPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <form method="post" id="create-menu-catalogue">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuPositionModalLabel">@lang('messages.menu.modal.title')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('messages.menu.modal.icons.close')"></button>
                </div> 
                <div class="modal-body">
                    @include('backend.component.requiredFields')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="positionName" class="form-label">
                                @lang('messages.menu.modal.fields.position_name.label') 
                                <i class="uil uil-exclamation-circle text-danger" title="@lang('messages.menu.modal.icons.required')"></i>
                            </label>
                            <input type="text" class="form-control name" id="positionName" name="name" 
                                   placeholder="@lang('messages.menu.modal.fields.position_name.placeholder')" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="positionKeyword" class="form-label">
                                @lang('messages.menu.modal.fields.keyword.label') 
                                <i class="uil uil-exclamation-circle text-danger" title="@lang('messages.menu.modal.icons.required')"></i>
                            </label>
                            <input type="text" id="keyword" class="form-control keyword" id="positionKeyword" name="keyword" 
                                   placeholder="@lang('messages.menu.modal.fields.keyword.placeholder')" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i> @lang('messages.menu.modal.buttons.close')
                    </button>
                    <button type="submit" class="btn btn-primary submitCatalogueButton">
                        <i class="mdi mdi-content-save me-1"></i> @lang('messages.menu.modal.buttons.submit')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>