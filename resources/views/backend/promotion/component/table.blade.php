<div class="table-responsive">
    <table class="table align-middle table-bordered">
        <thead>
            <tr>
                <th style="vertical-align: middle; width: 50px;">
                    <div class="form-check font-size-16 d-flex justify-content-center">
                        <input class="form-check-input checkStatusAll" type="checkbox" id="customerlistcheck01">
                        <label class="form-check-label" for="customerlistcheck01"></label>
                    </div>
                </th>
                <th>@lang('messages.promotion.index.table.tableHeader.program_name')</th>
                <th>@lang('messages.promotion.index.table.tableHeader.discount')</th>
                <th>@lang('messages.promotion.index.table.tableHeader.information')</th>
                <th>@lang('messages.promotion.index.table.tableHeader.start_date')</th>
                <th>@lang('messages.promotion.index.table.tableHeader.end_date')</th>
                <th style="vertical-align: middle; width: 200px">{{ __('messages.status') }}</th>
                <th style="vertical-align: middle; width: 200px">{{ __('messages.actions.title') }}</th>
            </tr>
        </thead>
        <tbody class="data-table">
            
        </tbody>
    </table>
</div>
<ul class="pagination pagination-rounded justify-content-end mb-2">
    
</ul>
