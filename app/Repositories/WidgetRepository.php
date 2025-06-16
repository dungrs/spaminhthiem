<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\WidgetRepositoryInterface;
use App\Models\Widget;


class WidgetRepository extends BaseRepository implements WidgetRepositoryInterface {
    protected $model;

    public function __construct(Widget $model) {
        $this->model = $model;
    }
}