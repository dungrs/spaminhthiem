<div class="table-responsive">
    <table class="table align-middle">
        <thead class="table-light">
            <tr>
                <th>
                    <div class="form-check font-size-16">
                        <input class="form-check-input checkStatusAll" type="checkbox" id="customerlistcheck01">
                        <label class="form-check-label" for="customerlistcheck01"></label>
                    </div>
                </th>
                @foreach ($seoTableHeaders as $value)
                    <th>{{ $value }}</th>
                @endforeach
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.actions.title') }}</th>
            </tr>
        </thead>
        <tbody class="data-table">
           
        </tbody>
    </table>
</div>
<ul class="pagination pagination-rounded justify-content-end mb-2">
    
</ul>