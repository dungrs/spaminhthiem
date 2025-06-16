<?php

namespace App\Http\Controllers\Backend\Attribute;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Attribute\AttributeCatalogueService;

use App\Classes\Nestedsetbie;

class AttributeCatalogueController extends BackendController
{   
    protected $attributeCatalogueService;
    protected $nestedSet;
    protected $languageId;

    public function __construct(AttributeCatalogueService $attributeCatalogueService) {
        $this->attributeCatalogueService = $attributeCatalogueService;
        $this->middleware(function($request, $next) {
            $this->languageId = session('currentLanguage')->id;
            $this->initialize();
            return $next($request);
        });
        $this->initialize();
    }

    public function index(Request $request) {
        $this->authorize('modules', 'attribute.catalogue.index');
        $template = 'backend.attribute.catalogue.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.attribute_catalogue');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.attribute_catalogue');
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
        $this->authorize('modules', 'attribute.catalogue.create');
        $template = 'backend.attribute.catalogue.store';
        $dropdown = $this->nestedSet->Dropdown();
        $configs = $this->prepareConfigs('create');
        
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown'
        ));
    }

    public function edit($id, $languageId) {
        $this->authorize('modules', 'attribute.catalogue.update');
        $template = 'backend.attribute.catalogue.store';
        $this->languageId = $languageId;
        $this->initialize();
        $dropdown = $this->nestedSet->Dropdown();
        $attributeCatalogue = $this->attributeCatalogueService->getAttributeCatalogueDetails($id, $languageId);
        
        $configs = $this->prepareConfigs('edit');

        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown', 
            'attributeCatalogue'
        ));
    }

    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/attribute_catalogues.js'
            ],
            'model' => 'AttributeCatalogue',
            'modelParent' => 'Attribute'
        ];
    }

    private function initialize() {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'attribute_catalogues',
            'foreignkey' => 'attribute_catalogue_id',
            'language_id' => $this->languageId,
        ]);
    }
}
