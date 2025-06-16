<?php

namespace App\Http\Controllers\Ajax\Post;

use App\Http\Controllers\BackendController;
use App\Services\Post\PostCatalogueService;

use App\Http\Requests\Post\StorePostCatalogueRequest;
use App\Http\Requests\Post\UpdatePostCatalogueRequest;
use App\Http\Requests\Post\DeletePostCatalogueRequest;

use Illuminate\Http\Request;

class PostCatalogueController extends BackendController
{   
    protected $postCatalogueService; 

    public function __construct(PostCatalogueService $postCatalogueService) {
        $this->postCatalogueService = $postCatalogueService;
    }

    public function filter(Request $request) {
        $postCatalogues = $this->postCatalogueService->paginate($request);
        return $postCatalogues;
    } 

    public function create(StorePostCatalogueRequest $request) {
        $response = $this->postCatalogueService->create($request);
        return $response;
    }
    public function update(UpdatePostCatalogueRequest $request, $id, $languageId) {
        $response = $this->postCatalogueService->update($request, $id, $languageId);
        return $response;
    }

    public function delete(DeletePostCatalogueRequest $request, $id) {
        $this->authorize('modules', 'post.catalogue.destroy');
        $response = $this->postCatalogueService->delete($id);
        return $response;
    }
}
