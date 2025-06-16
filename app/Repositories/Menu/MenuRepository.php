<?php

namespace App\Repositories\Menu;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\Menu\MenuRepositoryInterface;
use App\Models\Menu;


class MenuRepository extends BaseRepository implements MenuRepositoryInterface {
    protected $model;

    public function __construct(Menu $model) {
        $this->model = $model;
    }

    public function deleteChildren($parentId) {
        return $this->model->where('parent_id', $parentId)->delete();
    }
}