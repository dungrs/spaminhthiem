<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\OrderService;
use App\Services\Customer\CustomerService;

class BackendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $orderService;
    protected $customerService;

    public function __construct(OrderService $orderService, CustomerService $customerService) {
        $this->orderService = $orderService;
        $this->customerService = $customerService;

        $this->shareStatistics();
    }

    protected function shareStatistics() {
        $orderStatistic = $this->orderService->orderStatistic();
        $customerStatistic = $this->customerService->customerStatistic();

        view()->share('orderStatistic', $orderStatistic);
        view()->share('customerStatistic', $customerStatistic);
    }
}
