<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;
use App\Services\SlideService;

use App\Http\Requests\Slide\StoreSlideRequest;
use App\Http\Requests\Slide\UpdateSlideRequest;

use Illuminate\Http\Request;

class SlideController extends BackendController
{   
    protected $slideService; 

    public function __construct(SlideService $slideService) {
        $this->slideService = $slideService;
    }

    public function filter(Request $request) {
        $slides = $this->slideService->paginate($request);
        return $slides;
    } 

    public function create(StoreSlideRequest $request) {
        $response = $this->slideService->create($request);
        return $response;
    }

    public function update(UpdateSlideRequest $request, $id) {
        $response = $this->slideService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'slide.destroy');
        $response = $this->slideService->delete($id);
        return $response;
    }
}
