<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\SlideService;


class SlideController extends BackendController
{   
    protected $slideService;
    protected $languageId;

    public function __construct(SlideService $slideService) {
        $this->slideService = $slideService;
        $this->middleware(function($request, $next) {
            $this->languageId = session('currentLanguage')->id;
            return $next($request);
        });
    }

    public function index(Request $request) {
        $this->authorize('modules', 'slide.index');
        $template = 'backend.slide.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.slide');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
        ));
    }

    public function create() {
        $this->authorize('modules', 'slide.create');
        $template = 'backend.slide.store';
        $configs = $this->prepareConfigs('create');
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
        ));
    }

    public function edit($id) {
        $this->authorize('modules', 'slide.update');
        $template = 'backend.slide.store';
        $slide = $this->slideService->getSlideDetails($id);
        $slideItem = $this->slideService->convertSlideArray($slide->item[$this->languageId]);
        $configs = $this->prepareConfigs('edit');
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'slide',
            'slideItem',
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/slides.js'
            ],
            'model' => 'Slide',
            'modelParent' => ''
        ];
    }
    
    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.slide');
        $configs['method'] = $method;
        
        $additionalJs = [
            'backend/libs/ckfinder/ckfinder.js',
            'backend/js/ckfinder.js',
            'backend/js/seo.js',
        ];

        $configs['js'] = array_merge($configs['js'], $additionalJs);
        
        return $configs;
    }
}
