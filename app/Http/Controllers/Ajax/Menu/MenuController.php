<?php

namespace App\Http\Controllers\Ajax\Menu;

use App\Http\Controllers\BackendController;
use App\Services\Menu\MenuService;
use App\Services\Menu\MenuCatalogueService;

use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\StoreMenuChildrenRequest;

use Illuminate\Http\Request;

class MenuController extends BackendController
{   
    protected $menuService; 
    protected $menuCatalogueService;

    public function __construct(MenuService $menuService, MenuCatalogueService $menuCatalogueService) {
        $this->menuService = $menuService;
        $this->menuCatalogueService = $menuCatalogueService;
    }

    public function filter(Request $request) {
        $menuCatalogues = $this->menuCatalogueService->paginate($request);
        return $menuCatalogues;
    } 


    public function getMenu(Request $request) {
        $response = $this->menuService->getMenu($request);
        return $response;
    }

    public function store(StoreMenuRequest $request) {
        $response = $this->menuService->save($request);
        return $response;
    }

    
    public function saveChildren(StoreMenuChildrenRequest $request, $id) {
        $response = $this->menuService->saveChildren($request, $id);
        return $response;
    }

    public function drag(Request $request) {
        $json = json_decode($request->string('json'), true);
        $menuCatalogueId = $request->integer("menu_catalogue_id");
        $flag = $this->menuService->dragUpdate($json, 0, $menuCatalogueId);
        return $flag;
    }

    public function saveTranslate(Request $request, $languageId) {
        $response = $this->menuService->saveTranslateMenu($request, $languageId);
        return $response;
    }
}
