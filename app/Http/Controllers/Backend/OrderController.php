<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\OrderService;

use App\Repositories\Location\ProvinceRepository;

class OrderController extends BackendController
{   
    protected $orderService;
    protected $provinceRepository;

    public function __construct(OrderService $orderService, ProvinceRepository $provinceRepository) {
        $this->orderService = $orderService;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'order.index');
        $template = 'backend.order.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.order');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
        ));
    }

    public function details($code) {
        $this->authorize('modules', 'order.update');
        $condition = [
            ['orders.code', '=', $code]
        ];
        $template = 'backend.order.details';
        $order = $this->orderService->getOrder($condition);
        $configs = $this->prepareConfigs('details');
        $provinces = $this->provinceRepository->all();
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs',
            'order',
            'provinces'
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/location.js',
                'backend/js/pages/orders.js'
            ],
            'model' => 'Order',
            'modelParent' => ''
        ];
    }
    
    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.order');
        $configs['method'] = $method;
        
        $additionalJs = [
            'backend/js/seo.js',
        ];

        $configs['js'] = array_merge($configs['js'], $additionalJs);
        
        return $configs;
    }
}
