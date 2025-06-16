<div class="table-responsive">
    <table class="table align-middle">
        <thead class="table-light">
            <tr>
                @foreach ($seoTableHeaders as $value)
                    <th>{{ $value }}</th>
                @endforeach
                <th>{{ __('messages.actions.title') }}</th>
            </tr>
        </thead>
        <tbody class="data-table">
           
        </tbody>
    </table>
</div>
<ul class="pagination pagination-rounded justify-content-end mb-2">
    
</ul>