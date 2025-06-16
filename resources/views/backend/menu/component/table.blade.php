<div class="table-responsive">
    <table class="table align-middle">
        <thead class="table-light">
            <tr>
                <th style="vertical-align: middle; width: 50px;">
                    <div class="form-check font-size-16 d-flex justify-content-center">
                        <input class="form-check-input checkStatusAll" type="checkbox" id="customerlistcheck01">
                        <label class="form-check-label" for="customerlistcheck01"></label>
                    </div>
                </th>
                @foreach ($seoTableHeaders as $value)
                    <th>{{ $value }}</th>
                @endforeach
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