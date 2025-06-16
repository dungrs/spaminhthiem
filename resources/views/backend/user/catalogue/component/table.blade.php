<div class="table-responsive">
    <table class="table align-middle table-bordered">
        <thead>
            <tr>
                <th style="vertical-align: middle">
                    <div class="form-check font-size-16">
                        <input class="form-check-input checkStatusAll" type="checkbox" id="customerlistcheck01">
                        <label class="form-check-label" for="customerlistcheck01"></label>
                    </div>
                </th>
                <th style="vertical-align: middle; width: 250px">{{ $seoTableHeaders['name'] }}</th>
                <th style="vertical-align: middle">{{ $seoTableHeaders['phone'] }}</th>
                <th style="vertical-align: middle">{{ $seoTableHeaders['email'] }}</th>
                <th style="vertical-align: middle">{{ $seoTableHeaders['user_count'] }}</th>
                <th style="vertical-align: middle">{{ __('messages.status') }}</th>
                <th style="vertical-align: middle">{{ __('messages.actions.title') }}</th>
            </tr>
        </thead>
        <tbody class="data-table">
            
        </tbody>
    </table>
</div>
<ul class="pagination pagination-rounded justify-content-end mb-2">
    
</ul>
