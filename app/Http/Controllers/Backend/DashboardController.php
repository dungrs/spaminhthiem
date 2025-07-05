<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;

use App\Services\OrderService;
use App\Services\Customer\CustomerService;
use App\Services\Product\ProductService;

class DashboardController extends BackendController
{   
    protected $orderService;
    protected $customerService;
    protected $productService;

    public function __construct(OrderService $orderService, ProductService $productService, CustomerService $customerService) {
        $this->orderService = $orderService;
        $this->customerService = $customerService;
        $this->productService = $productService;
    }

    public function index() {
        $template = 'backend.dashboard.home.index';
        $configs = $this->config();
        $configs['method'] = 'index';
        $configs['seo'] = __('messages.dashboard');
        $keywords = [
            'hot-deal' => ['keyword' => 'hot-deal', 'options' => ['object' => false, 'promotion' => true]],
        ];

        $bestSellProduct = $this->productService->getBestSellingProduct();

        $orderStatistic = $this->orderService->orderStatistic();
        $customerStatistic = $this->customerService->customerStatistic();
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'orderStatistic',
            'customerStatistic',
            'bestSellProduct',
        ));
    }

    public function config() {
        return [
            'js' => [
                'backend/js/pages/dashboards.js'
            ]
        ];
    }
}
