<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Models\Review;


class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface {
    protected $model;

    public function __construct(Review $model) {
        $this->model = $model;
    }
}