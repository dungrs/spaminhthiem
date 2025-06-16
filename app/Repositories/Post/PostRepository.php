<?php

namespace App\Repositories\Post;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\Post\PostRepositoryInterface;
use App\Models\Post;


class PostRepository extends BaseRepository implements PostRepositoryInterface {
    protected $model;

    public function __construct(Post $model) {
        $this->model = $model;
    }

    public function whereRaw($request, $languageId) {
        $rawCondition = [];
    
        $postCatalogueId = $request->integer('post_catalogue_id');
        
        if ($postCatalogueId > 0) {
            $rawCondition['whereRaw'] = [
                [
                    "psp.post_catalogue_id IN (
                        SELECT pc1.id
                        FROM post_catalogues AS pc1
                        JOIN post_catalogue_languages AS pcl 
                            ON pc1.id = pcl.post_catalogue_id
                        JOIN post_catalogues AS pc2 
                            ON pc2.id = ?
                        WHERE pc1.lft >= pc2.lft
                            AND pc1.rgt <= pc2.rgt
                            AND pcl.language_id = ?
                    )",
                    [$postCatalogueId, $languageId]
                ]
            ];
        }
    
        return $rawCondition;
    }
    
}