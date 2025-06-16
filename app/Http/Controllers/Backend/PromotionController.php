<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\PromotionService;
use App\Services\SourceService;

class PromotionController extends BackendController
{   
    protected $promotionService;
    protected $sourceService;

    public function __construct(PromotionService $promotionService, SourceService $sourceService) {
        $this->promotionService = $promotionService;
        $this->sourceService = $sourceService;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'promotion.index');
        $template = 'backend.promotion.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.promotion');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.promotion');
        $configs['method'] = $method;
        
        $additionalJs = [
            'backend/js/seo.js',
        ];

        $configs['js'] = array_merge($configs['js'], $additionalJs);
        
        return $configs;
    }

    public function create() {
        $this->authorize('modules', 'promotion.create');
        $template = 'backend.promotion.store';
        $configs = $this->prepareConfigs('create');
        
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
        ));
    }

    public function edit($id) {
        $this->authorize('modules', 'promotion.update');
        $template = 'backend.promotion.store';
        $configs = $this->prepareConfigs('edit');
        $promotion = $this->promotionService->getPromotionDetails($id);
        $inputProductAndQuantity = $this->promotionService->getInputProductAndQuantity($promotion);
        $promotionValue = $this->promotionService->getPromotionValue();
        $sources = $this->sourceService->getAll(false);
        
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs',
            'promotion',
            'inputProductAndQuantity',
            'sources',
            'promotionValue'
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/libs/flatpickr/flatpickr.min.js',
                'backend/libs/%40simonwep/pickr/pickr.min.js',
                'backend/js/library.js',
                'backend/js/pages/promotions.js'
            ],
            'css' => [
                'backend/libs/flatpickr/flatpickr.min.css'
            ],
            'model' => 'Promotion',
            'modelParent' => ''
        ];
    }
}
