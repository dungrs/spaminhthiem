<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Menu\MenuCatalogueService;

use App\Classes\Nestedsetbie;

class MenuCatalogueController extends BackendController
{   
    protected $menuCatalogueService;
    protected $languageId;

    public function __construct(MenuCatalogueService $menuCatalogueService) {
        $this->menuCatalogueService = $menuCatalogueService;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'menu.catalogue.index');
        $template = 'backend.menu.catalogue.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.menu_catalogue');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs'
        ));
    }

    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.menu_catalogue');
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
        $this->authorize('modules', 'menu.catalogue.create');
        $template = 'backend.menu.catalogue.store';
        $configs = $this->prepareConfigs('create');
        
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/menu_catalogues.js'
            ],
            'model' => 'MenuCatalogue',
            'modelParent' => 'Menu'
        ];
    }
}
