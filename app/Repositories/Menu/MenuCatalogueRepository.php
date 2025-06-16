<?php

namespace App\Repositories\Menu;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\Menu\MenuCatalogueRepositoryInterface;
use App\Models\MenuCatalogue;


class MenuCatalogueRepository extends BaseRepository implements MenuCatalogueRepositoryInterface {
    protected $model;

    public function __construct(MenuCatalogue $model) {
        $this->model = $model;
    }
}