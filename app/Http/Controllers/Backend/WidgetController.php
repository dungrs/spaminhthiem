<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\WidgetService;
use App\Services\LanguageService;


class WidgetController extends BackendController
{   
    protected $widgetService;
    protected $languageService;

    public function __construct(WidgetService $widgetService, LanguageService $languageService) {
        $this->widgetService = $widgetService;
        $this->languageService = $languageService;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'widget.index');
        $template = 'backend.widget.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.widget');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.widget');
        $configs['method'] = $method;
        
        $additionalJs = [
            'backend/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js',
            'backend/libs/ckfinder/ckfinder.js',
            'backend/js/ckfinder.js',
            'backend/js/ckeditor.js',
            'backend/js/seo.js',
        ];

        $configs['js'] = array_merge($configs['js'], $additionalJs);
        
        return $configs;
    }

    public function create() {
        $this->authorize('modules', 'widget.create');
        $template = 'backend.widget.store';
        $configs = $this->prepareConfigs('create');
        
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
        ));
    }

    public function edit($id, $languageId) {
        $this->authorize('modules', 'widget.update');
        $template = 'backend.widget.store';
        $configs = $this->prepareConfigs('edit');
        $widget = $this->widgetService->getWidgetDetails($id, $languageId);
        $widgetItem = $this->widgetService->getWidgetItem($widget, $widget->model_id, $languageId);
        $album_json = json_encode($widget->album);
        $album = json_decode($album_json);

        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'widget',
            'album',
            'widgetItem'
        ));
    }

    public function translate($id, $languageId) {
        $this->authorize('modules', 'widget.translate');
        $template = 'backend.widget.translate';
        $configs = $this->prepareConfigs('translate');
        $widget = $this->widgetService->getWidgetDetails($id, $languageId);
        $widgetTranslate = $this->widgetService->getWidgetOtherLanguages($id, $languageId);
        $languageOther = $this->languageService->getLanguageOtherSelect($languageId);
        $option = [
            'id' => $id,
            'languageId' => $languageId,
        ];

        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'widget',
            'widgetTranslate',
            'languageOther',
            'option',
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/js/jquery-ui.js',
                'backend/js/library.js',
                'backend/js/pages/widgets.js',
            ],
            'css' => [
                'backend/libs/dropzone/min/dropzone.min.css'
            ],
            'model' => 'Widget',
            'modelParent' => ''
        ];
    }
}
