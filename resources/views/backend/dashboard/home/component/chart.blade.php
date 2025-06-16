<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pb-2">
                <!-- Header Section -->
                <div class="d-flex align-items-start mb-4 mb-xl-0">
                    <div class="flex-grow-1">
                        <h5 class="card-title">@lang('messages.dashboard.chart.revenue_chart')</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset chart-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold">@lang('messages.dashboard.chart.sort_by')</span>
                                <span class="text-muted">@lang('messages.dashboard.chart.sort_options.year')<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item chartButton active" data-chart="1">@lang('messages.dashboard.chart.sort_options.year')</a>
                                <a class="dropdown-item chartButton" data-chart="30">@lang('messages.dashboard.chart.sort_options.30_days')</a>
                                <a class="dropdown-item chartButton" data-chart="7">@lang('messages.dashboard.chart.sort_options.7_days')</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Revenue Chart Section -->
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <div>
                            <div id="column_chart" data-colors='["--bs-primary", "--bs-primary-rgb, 0.2"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-2">@lang('messages.dashboard.chart.order_stats')</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset donut-chart-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold">@lang('messages.dashboard.chart.sort_by')</span> 
                                <span class="text-muted">@lang('messages.dashboard.chart.sort_options.year')<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item pieChartButton active" data-chart="1">@lang('messages.dashboard.chart.sort_options.year')</a>
                                <a class="dropdown-item pieChartButton" data-chart="30">@lang('messages.dashboard.chart.sort_options.month')</a>
                                <a class="dropdown-item pieChartButton" data-chart="7">@lang('messages.dashboard.chart.sort_options.7_days')</a>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div id="chart-donut" data-colors='["--bs-primary", "--bs-success","--bs-danger"]' class="apex-charts" dir="ltr"></div>
    
                <div class="mt-1 px-2">
                    <div class="order-wid-list order-completed d-flex justify-content-between border-bottom">
                        <p class="mb-0">
                            <i class="mdi mdi-square-rounded font-size-10 text-primary me-2"></i>@lang('messages.dashboard.chart.order_status.completed')
                        </p>
                        <div>
                            <span class="pe-5 completed-orders-count">56,236</span>
                            <span class="badge bg-primary completed-orders-change"> + 0.2% </span>
                        </div>
                    </div>
                    <div class="order-wid-list order-processing d-flex justify-content-between border-bottom">
                        <p class="mb-0">
                            <i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>@lang('messages.dashboard.chart.order_status.processing')
                        </p>
                        <div>
                            <span class="pe-5 processing-orders-count">12,596</span>
                            <span class="badge bg-success processing-orders-change"> - 0.7% </span>
                        </div>
                    </div>
                    <div class="order-wid-list order-canceled d-flex justify-content-between">
                        <p class="mb-0">
                            <i class="mdi mdi-square-rounded font-size-10 text-danger me-2"></i>@lang('messages.dashboard.chart.order_status.canceled')
                        </p>
                        <div>
                            <span class="pe-5 canceled-orders-count">1,568</span>
                            <span class="badge bg-danger canceled-orders-change"> + 0.4% </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end row-->