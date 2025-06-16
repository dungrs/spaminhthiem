<?php

namespace App\Http\Controllers\Ajax\Menu;

use App\Http\Controllers\BackendController;
use App\Services\Menu\MenuCatalogueService;

use App\Http\Requests\Menu\StoreMenuCatalogueRequest;
use App\Http\Requests\Menu\UpdateMenuCatalogueRequest;

use Illuminate\Http\Request;

class MenuCatalogueController extends BackendController
{   
    protected $menuCatalogueService; 

    public function __construct(MenuCatalogueService $menuCatalogueService) {
        $this->menuCatalogueService = $menuCatalogueService;
    }

    public function filter(Request $request) {
        $menuCatalogues = $this->menuCatalogueService->paginate($request);
        return $menuCatalogues;
    } 

    public function create(StoreMenuCatalogueRequest $request) {
        $response = $this->menuCatalogueService->create($request);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'menu.catalogue.destroy');
        $response = $this->menuCatalogueService->delete($id);
        return $response;
    }
}
