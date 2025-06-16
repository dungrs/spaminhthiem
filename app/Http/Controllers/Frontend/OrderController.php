<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

use App\Repositories\SystemRepository;

use App\Services\OrderService;

use Illuminate\Http\Request;

class OrderController extends FrontendController
{   
    protected $orderService;

    public function __construct(
        SystemRepository $systemRepository,
        OrderService $orderService,
    ) {
        parent::__construct($systemRepository);
        $this->orderService = $orderService;
    }

    
    public function lookup() {
        $seo = [
            'meta_title' => 'Tìm kiếm hóa đơn',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'canonical' => writeUrl('gio-hang', true, true)
        ];

        $template = 'frontend.lookup.index';
        $extra = [
            'template' => $template,
            'seo' => $seo,
        ];
        return view('frontend.homepage.layout', $this->prepareViewData($extra));
    }

    public function getOrder(Request $request) {
        $code = $request->input('code');
        $seo = [
            'meta_title' => 'Tìm kiếm hóa đơn',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'canonical' => writeUrl('gio-hang', true, true)
        ];
    
        $order = $this->orderService->getOrderByCode($code);
        
        $template = 'frontend.lookup.index';
        $data = [
            'order' => $order,
            'code' => $code,
        ];

        $extra = [
            'template' => $template,
            'data' => $data,
            'seo' => $seo,
        ];
    
        return view('frontend.homepage.layout', $this->prepareViewData($extra));
    }
    
    protected function prepareViewData(array $extra = []) {
        $config = $this->config();
        $systems = $this->getSystem();
        
        $base = compact('config', 'systems');

        return array_merge($base, $extra);
    }

    private function config() {
        return [
            'language' => $this->language,
            'js' => [

            ],
        ];
    }
}
