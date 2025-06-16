<!-- start dash info -->
<div class="row">
    <div class="col-xl-12">
        <div class="card dash-header-box shadow-none border-0">
            <div class="card-body p-0">
                <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                    <div class="col">
                        <div class="mt-md-0 py-3 px-4 mx-2">
                            <p class="text-white-50 mb-2 text-truncate">@lang('messages.stats.monthly_orders')</p>
                            <h3 class="text-white mb-0">{{ $orderStatistic['orderStatisticMonth']->current_month_orders }}</h3>
                        </div>
                    </div><!-- end col -->

                    <div class="col">
                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                            <p class="text-white-50 mb-2 text-truncate">@lang('messages.stats.total_orders')</p>
                            <h3 class="text-white mb-0">{{ $orderStatistic['orderStatisticMonth']->total_orders }}</h3>
                        </div>
                    </div><!-- end col -->

                    <div class="col">
                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                            <p class="text-white-50 mb-2 text-truncate">@lang('messages.stats.monthly_revenue')</p>
                            <h3 class="text-white mb-0">{{ convert_price($orderStatistic['orderRevenue']['current_month_revenue']) }}</h3>
                        </div>
                    </div><!-- end col -->

                    <div class="col">
                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                            <p class="text-white-50 mb-2 text-truncate">@lang('messages.stats.total_customers')</p>
                            <h3 class="text-white mb-0">{{ $customerStatistic['totalCustomer'] }}</h3>
                        </div>
                    </div><!-- end col -->

                    <div class="col">
                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                            <p class="text-white-50 mb-2 text-truncate">@lang('messages.stats.new_customers')</p>
                            <h3 class="text-white mb-0">{{ $customerStatistic['newTotalCustomer'] }}</h3>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>
<!-- end dash info -->