<?php

namespace App\Http\Controllers\Ajax\Post;

use App\Http\Controllers\BackendController;
use App\Services\Post\PostService;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

use Illuminate\Http\Request;

class PostController extends BackendController
{   
    protected $postService; 

    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }

    public function filter(Request $request) {
        $posts = $this->postService->paginate($request);
        return $posts;
    } 

    public function create(StorePostRequest $request) {
        $response = $this->postService->create($request);
        return $response;
    }
    public function update(UpdatePostRequest $request, $id, $languageId) {
        $response = $this->postService->update($request, $id, $languageId);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'post.destroy');
        $response = $this->postService->delete($id);
        return $response;
    }
}
