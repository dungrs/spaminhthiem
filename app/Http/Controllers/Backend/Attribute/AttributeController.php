<?php

namespace App\Http\Controllers\Backend\Attribute;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Attribute\AttributeService;

use App\Classes\Nestedsetbie;

class AttributeController extends BackendController
{   
    protected $attributeService;
    protected $nestedSet;
    protected $languageId;

    public function __construct(AttributeService $attributeService) {
        $this->attributeService = $attributeService;
        $this->middleware(function($request, $next) {
            $this->languageId = session('currentLanguage')->id;
            $this->initialize();
            return $next($request);
        });
        $this->initialize();
    }

    public function index(Request $request) {
        $this->authorize('modules', 'attribute.index');
        $template = 'backend.attribute.attribute.index';
        $dropdown = $this->nestedSet->Dropdown();
        $configs = $this->configs();
        $configs['seo'] = __('messages.attribute');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'dropdown'
        ));
    }

    public function create() {
        $this->authorize('modules', 'attribute.create');
        $template = 'backend.attribute.attribute.store';
        $dropdown = $this->nestedSet->Dropdown();
        $configs = $this->prepareConfigs('create');
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown'
        ));
    }

    public function edit($id, $languageId) {
        $this->authorize('modules', 'attribute.update');
        $template = 'backend.attribute.attribute.store';
        $this->languageId = $languageId;
        $this->initialize();
        $dropdown = $this->nestedSet->Dropdown();
        $attribute = $this->attributeService->getAttributeDetails($id, $languageId);
        $configs = $this->prepareConfigs('edit');
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown', 
            'attribute'
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/attributes.js'
            ],
            'model' => 'Attribute',
            'modelParent' => 'Attribute'
        ];
    }
    
    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.attribute');
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

    private function initialize() {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'attribute_catalogues',
            'foreignkey' => 'attribute_catalogue_id',
            'language_id' => $this->languageId,
        ]);
    }
}
