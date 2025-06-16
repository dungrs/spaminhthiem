<?php

namespace App\Repositories\Post;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\Post\PostCatalogueRepositoryInterface;
use App\Models\PostCatalogue;


class PostCatalogueRepository extends BaseRepository implements PostCatalogueRepositoryInterface {
    protected $model;

    public function __construct(PostCatalogue $model) {
        $this->model = $model;
    }
}