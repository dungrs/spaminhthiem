<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;

use App\Services\ReviewService;

use Illuminate\Http\Request;

class ReviewController extends BackendController
{   
    protected $reviewService; 

    public function __construct(ReviewService $reviewService) {
        $this->reviewService = $reviewService;
    }

    public function create(Request $request) {
        $response = $this->reviewService->create($request);
        return $response;
    }

    public function toggleLike(Request $request) {
        $response = $this->reviewService->toggleLike($request);
        return $response;
    }
    
    public function filter(Request $request) {
        $reviews = $this->reviewService->paginate($request);
        return $reviews;
    }

    public function delete($id) {
        $this->authorize('modules', 'review.destroy');
        $response = $this->reviewService->delete($id);
        return $response;
    }
}
