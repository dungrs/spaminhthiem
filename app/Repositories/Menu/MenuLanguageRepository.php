<?php

namespace App\Repositories\Menu;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\Menu\MenuLanguageRepositoryInterface;
use App\Models\MenuLanguage;


class MenuLanguageRepository extends BaseRepository implements MenuLanguageRepositoryInterface {
    protected $model;

    public function __construct(MenuLanguage $model) {
        $this->model = $model;
    }
}