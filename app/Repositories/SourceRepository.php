<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SourceRepositoryInterface;
use App\Models\Source;


class SourceRepository extends BaseRepository implements SourceRepositoryInterface {
    protected $model;

    public function __construct(Source $model) {
        $this->model = $model;
    }
}