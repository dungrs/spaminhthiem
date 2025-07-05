<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body pb-3">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-2">@lang('messages.dashboard.sale_best_product.sales_by_social_source.title')</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('messages.dashboard.sale_best_product.sales_by_social_source.time_periods.monthly')<i class="mdi mdi-chevron-down ms-1"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">@lang('messages.dashboard.sale_best_product.sales_by_social_source.time_periods.yearly')</a>
                                <a class="dropdown-item" href="#">@lang('messages.dashboard.sale_best_product.sales_by_social_source.time_periods.monthly')</a>
                                <a class="dropdown-item" href="#">@lang('messages.dashboard.sale_best_product.sales_by_social_source.time_periods.weekly')</a>
                                <a class="dropdown-item" href="#">@lang('messages.dashboard.sale_best_product.sales_by_social_source.time_periods.today')</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 pt-1">
                    <div class="social-box row align-items-center border-bottom pt-0 g-0">
                        <div class="col-12 col-sm-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-primary">
                                            <i class="mdi mdi-facebook font-size-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.facebook.name')</h5>
                                    <p class="text-muted mb-0">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.facebook.category')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="mt-3 mt-md-0 text-md-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.orders', ['count' => '4,562'])</h5>
                                <p class="text-muted mb-0 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.likes', ['count' => '4.2'])</p>
                            </div>
                        </div>
                        <div class="col-auto col-sm-4">
                            <div class="mt-3 mt-md-0 text-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.revenue', ['amount' => '47.526.000'])</h5>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-success"><i class="mdi mdi-arrow-top-right me-1"></i>@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.growth.positive', ['percent' => '50'])</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="social-box row align-items-center border-bottom g-0">
                        <div class="col-12 col-sm-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-info">
                                            <i class="mdi mdi-twitter font-size-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.twitter.name')</h5>
                                    <p class="text-muted mb-0">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.twitter.category')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="mt-3 mt-md-0 text-md-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.orders', ['count' => '1,652'])</h5>
                                <p class="text-muted mb-0 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.likes', ['count' => '3.7'])</p>
                            </div>
                        </div>
                        <div class="col-auto col-sm-4">
                            <div class="mt-3 mt-md-0 text-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.revenue', ['amount' => '52.785.000'])</h5>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-success"><i class="mdi mdi-arrow-top-right me-1"></i>@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.growth.positive', ['percent' => '45'])</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="social-box row align-items-center border-bottom g-0">
                        <div class="col-12 col-sm-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-danger">
                                            <i class="mdi mdi-linkedin font-size-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.linkedin.name')</h5>
                                    <p class="text-muted mb-0">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.linkedin.category')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="mt-3 mt-md-0 text-md-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.orders', ['count' => '5,256'])</h5>
                                <p class="text-muted mb-0 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.likes', ['count' => '3.3'])</p>
                            </div>
                        </div>
                        <div class="col-auto col-sm-4">
                            <div class="mt-3 mt-md-0 text-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.revenue', ['amount' => '52.785.000'])</h5>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-danger"><i class="mdi mdi-arrow-bottom-right me-1"></i>@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.growth.negative', ['percent' => '30'])</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="social-box row align-items-center border-bottom g-0">
                        <div class="col-12 col-sm-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-danger">
                                            <i class="mdi mdi-youtube font-size-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.youtube.name')</h5>
                                    <p class="text-muted mb-0">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.youtube.category')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="mt-3 mt-md-0 text-md-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.orders', ['count' => '6,965'])</h5>
                                <p class="text-muted mb-0 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.likes', ['count' => '3.7'])</p>
                            </div>
                        </div>
                        <div class="col-auto col-sm-4">
                            <div class="mt-3 mt-md-0 text-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.revenue', ['amount' => '86.456.000'])</h5>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-success"><i class="mdi mdi-arrow-top-right me-1"></i>@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.growth.positive', ['percent' => '35'])</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="social-box row align-items-center border-bottom g-0">
                        <div class="col-12 col-sm-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-primary">
                                            <i class="mdi mdi-instagram font-size-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.instagram.name')</h5>
                                    <p class="text-muted mb-0">@lang('messages.dashboard.sale_best_product.sales_by_social_source.platforms.instagram.category')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="mt-3 mt-md-0 text-md-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.orders', ['count' => '8,532'])</h5>
                                <p class="text-muted mb-0 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.likes', ['count' => '4.2'])</p>
                            </div>
                        </div>
                        <div class="col-auto col-sm-4">
                            <div class="mt-3 mt-md-0 text-end">
                                <h5 class="font-size-15 mb-1 text-truncate">@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.revenue', ['amount' => '92.452.000'])</h5>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-success"><i class="mdi mdi-arrow-top-right me-1"></i>@lang('messages.dashboard.sale_best_product.sales_by_social_source.metrics.growth.positive', ['percent' => '35'])</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title">@lang('messages.dashboard.sale_best_product.best_selling_products.title')</h5>
                    </div>
                </div>

                @if (isset($bestSellProduct))
                    <div class="slider mt-4">
                        <!-- Navigation buttons -->
                        <div class="swiper-button-next"><i class="mdi mdi-arrow-right"></i></div>
                        <div class="swiper-button-prev"><i class="mdi mdi-arrow-left"></i></div>
                        
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($bestSellProduct as $object)
                                    @include('backend.dashboard.home.component.productItem', ['product' => $object])
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> <!-- end row -->