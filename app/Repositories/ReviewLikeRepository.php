<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ReviewLikeRepositoryInterface;
use App\Models\ReviewLike;


class ReviewLikeRepository extends BaseRepository implements ReviewLikeRepositoryInterface {
    protected $model;

    public function __construct(ReviewLike $model) {
        $this->model = $model;
    }
}