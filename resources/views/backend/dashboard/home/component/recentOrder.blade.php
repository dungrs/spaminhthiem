<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body pb-0">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title">@lang('messages.dashboard.sales_recent_orders.sales_revenue.title')</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold">@lang('messages.dashboard.sales_recent_orders.sales_revenue.year_selection.label')</span> 
                                <span class="text-muted">
                                    @lang('messages.dashboard.sales_recent_orders.sales_revenue.year_selection.placeholder')<i class="mdi mdi-chevron-down ms-1"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @foreach(__('messages.dashboard.sales_recent_orders.sales_revenue.year_selection.options') as $year => $yearLabel)
                                    <a class="dropdown-item" href="#">{{ $yearLabel }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div id="world-map-markers" style="height: 230px;"></div>
                </div>

                <div>
                    <div id="sales-countries" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pb-3">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-2">@lang('messages.dashboard.sales_recent_orders.recent_orders.title')</h5>
                    </div>
                </div>

                <div class="">
                    <div class="table-responsive">
                        <table class="table project-list-table table-nowrap align-middle table-borderless mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('messages.dashboard.sales_recent_orders.recent_orders.table.headers.order_code')</th>
                                    <th scope="col" style="width: @lang('messages.dashboard.sales_recent_orders.recent_orders.table.headers.customer_col_width')">
                                        @lang('messages.dashboard.sales_recent_orders.recent_orders.table.headers.customer')
                                    </th>
                                    <th scope="col">@lang('messages.dashboard.sales_recent_orders.recent_orders.table.headers.price')</th>
                                    <th scope="col">@lang('messages.dashboard.sales_recent_orders.recent_orders.table.headers.payment_status')</th>
                                    <th scope="col">@lang('messages.dashboard.sales_recent_orders.recent_orders.table.headers.confirmation')</th>
                                    <th scope="col">@lang('messages.dashboard.sales_recent_orders.recent_orders.table.headers.actions')</th>
                                </tr>
                            </thead>
                            <tbody class="data-table">
                                <!-- Dynamic content will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end row -->