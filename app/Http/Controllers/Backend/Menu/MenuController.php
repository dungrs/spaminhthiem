<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\Menu\MenuService;
use App\Services\Menu\MenuCatalogueService;
use App\Services\LanguageService;

class MenuController extends BackendController
{
    protected $menuService;
    protected $menuCatalogueService;
    protected $languageService;
    protected $nestedSet;
    protected $languageId;

    public function __construct(MenuService $menuService, MenuCatalogueService $menuCatalogueService, LanguageService $languageService) {
        $this->menuService = $menuService;
        $this->menuCatalogueService = $menuCatalogueService;
        $this->languageService = $languageService;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'menu.index');
        $template = 'backend.menu.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.menu');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
        ));
    }

    public function create() {
        $this->authorize('modules', 'menu.create');
        $template = 'backend.menu.store';
        $configs = $this->prepareConfigs('create');
        $menuCatalogues = $this->menuCatalogueService->getMenuCatalogues();
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'menuCatalogues',
        ));
    }

    public function edit($id) {
        $this->authorize('modules', 'menu.update');
        $template = 'backend.menu.show';
        $menus = $this->menuService->getMenuDetails($id);
        $menuList = $menus['menuList'];
        $menuCatalogue = $menus['menuCatalogue'];
        $languageId = $menus['languageId'];
        $configs = $this->prepareConfigs('edit');
    
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs',
            'menuList',
            'menuCatalogue',
            'languageId',
        ));
    }

    public function editMenu($id) {
        $this->authorize('modules', 'menu.update');
        $template = 'backend.menu.store';
        $configs = $this->prepareConfigs('update');

        $menuCatalogues = $this->menuCatalogueService->getMenuCatalogues();
        $menuList = $this->menuService->getAndConvertMenu(0, $id);
        $menu = $this->menuService->getMenuByCatalogue($id);
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'menuCatalogues',
            'menuList',
            'menu'
        ));
    }

    public function children($id, $menuCatalogueId) {
        $this->authorize('modules', 'menu.update');
        $template = 'backend.menu.children';
        $menu = $this->menuService->getDetails($id);
        $menuList = $this->menuService->getAndConvertMenu($id, $menuCatalogueId);
        $configs = $this->prepareConfigs('children');
    
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'menuList',
            'menu'
        ));
    }

    public function translate($id, $languageId) {
        $this->authorize('modules', 'menu.translate');
        $template = 'backend.menu.translate';
        $configs = $this->prepareConfigs('translate');

        $menuCatalogue = $this->menuCatalogueService->getMenuCatalogueById($id);
        $conditons = [
            ['menu_catalogue_id', '=', $id],
            ['language_id', '=', $languageId]
        ];
        $menuItems = $this->menuService->queryMenuWithCondition($conditons);
        $menuBuildItem = $this->menuService->findMenuItemTranslate($menuItems, $menuCatalogue->id, $languageId);
        return view('backend.dashboard.layout', compact(
            'template', 
            'configs', 
            'menuBuildItem'
        ));
    }
    
    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/seo.js',
                'backend/js/pages/menus.js'
            ],
            'model' => 'MenuCatalogue',
            'modelParent' => 'Menu'
        ];
    }
    
    private function prepareConfigs($method) {
        $configs = $this->configs();
        $configs['seo'] = __('messages.menu');
        $configs['method'] = $method;
        
        $additionalJs = [
            'backend/libs/nestable/jquery.nestable.js',
        ];

        $configs['js'] = array_merge($configs['js'], $additionalJs);
        
        return $configs;
    }
}
