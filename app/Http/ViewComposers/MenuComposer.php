<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Menu\MenuCatalogueRepository;

class MenuComposer {

    protected $menuCatalogueRepository;
    protected $language;

    public function __construct(MenuCatalogueRepository $menuCatalogueRepository, $language) {
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->language = $language;
    }

    public function compose(View $view) {
        $menuCatalogueItems = $this->menuCatalogueRepository->all();
        $responses = [];
        foreach ($menuCatalogueItems as $menuCatalogueItem) {
            $menus = resolveInstance('Menu', 'Menu', 'Repositories', 'Repository')->findByCondition(
                [
                    ['menu_catalogue_id', '=', $menuCatalogueItem->id],
                    ['language_id', '=', $this->language]
                ],
                true,
                [
                    [
                        'table' => 'menu_languages',
                        'on' => [['menu_languages.menu_id', 'menus.id']]
                    ],
                    [
                        'table' => 'menu_catalogues',
                        'on' => [['menu_catalogues.id', 'menus.menu_catalogue_id']]
                    ],
                ],
                ['menus.order' => 'ASC'],
                ['menus.*', 'menu_languages.*', 'menu_catalogues.name as menu_catalogue_name']
            );
        
            $menuList = !empty($menus) ? recursive($menus, 0) : [];
            $responses[$menuCatalogueItem->keyword] = $menuList;
        }

        $view->with('menus', $responses);
    }
}
