<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OrderService;
use App\Services\Customer\CustomerService;

class ViewStatsProvider extends ServiceProvider
{
    protected $orderService;
    protected $customerService;

    public function __construct() {
        $this->orderService = app(OrderService::class);
        $this->customerService = app(CustomerService::class);
    }

    public function boot() {
        $orderStatistic = $this->orderService->orderStatistic();
        $customerStatistic = $this->customerService->customerStatistic();

        view()->share('orderStatistic', $orderStatistic);
        view()->share('customerStatistic', $customerStatistic);
    }

    public function register()
    {
        // Thực hiện đăng ký các dịch vụ nếu cần thiết
    }
}
