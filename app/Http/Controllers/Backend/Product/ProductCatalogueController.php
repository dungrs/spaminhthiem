<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Product\ProductCatalogueService;

use App\Classes\Nestedsetbie;

class ProductCatalogueController extends BackendController
{   
    protected $productCatalogueService;
    protected $nestedSet;
    protected $languageId;

    public function __construct(ProductCatalogueService $productCatalogueService) {
        $this->productCatalogueService = $productCatalogueService;
        $this->middleware(function($request, $next) {
            $this->languageId = session('currentLanguage')->id;
            $this->initialize();
            return $next($request);
        });
        $this->initialize();
    }

    public function index(Request $request) {
        $this->authorize('modules', 'product.catalogue.index');
        $template = 'backend.product.catalogue.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.product_catalogue');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.product_catalogue');
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
        $this->authorize('modules', 'product.catalogue.create');
        $template = 'backend.product.catalogue.store';
        $dropdown = $this->nestedSet->Dropdown();
        $configs = $this->prepareConfigs('create');
        
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown'
        ));
    }

    public function edit($id, $languageId) {
        $this->authorize('modules', 'product.catalogue.update');
        $template = 'backend.product.catalogue.store';
        $this->languageId = $languageId;
        $this->initialize();
        $dropdown = $this->nestedSet->Dropdown();
        $productCatalogue = $this->productCatalogueService->getProductCatalogueDetails($id, $languageId);
        
        $configs = $this->prepareConfigs('edit');

        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'dropdown', 
            'productCatalogue'
        ));
    }

    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/product_catalogues.js'
            ],
            'model' => 'ProductCatalogue',
            'modelParent' => 'Product'
        ];
    }

    private function initialize() {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => $this->languageId,
        ]);
    }
}