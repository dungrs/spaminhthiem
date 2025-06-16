<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use App\Models\Slide;


class SlideRepository extends BaseRepository implements SlideRepositoryInterface {
    protected $model;

    public function __construct(Slide $model) {
        $this->model = $model;
    }
}