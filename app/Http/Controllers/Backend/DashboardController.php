<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;

use App\Services\OrderService;
use App\Services\WidgetService;
use App\Services\Customer\CustomerService;

class DashboardController extends BackendController
{   
    protected $orderService;
    protected $customerService;
    protected $widgetService;

    public function __construct(OrderService $orderService, WidgetService $widgetService, CustomerService $customerService) {
        $this->orderService = $orderService;
        $this->widgetService = $widgetService;
        $this->customerService = $customerService;
    }

    public function index() {
        $template = 'backend.dashboard.home.index';
        $configs = $this->config();
        $configs['method'] = 'index';
        $configs['seo'] = __('messages.dashboard');
        $keywords = [
            'hot-deal' => ['keyword' => 'hot-deal', 'options' => ['object' => false, 'promotion' => true]],
        ];

        $widgets = $this->widgetService->getWidget($keywords, 1);
        $orderStatistic = $this->orderService->orderStatistic();
        $customerStatistic = $this->customerService->customerStatistic();
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'orderStatistic',
            'customerStatistic',
            'widgets',
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
