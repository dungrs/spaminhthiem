<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;
use App\Services\PromotionService;

use App\Http\Requests\Promotion\StorePromotionRequest;
use App\Http\Requests\Promotion\UpdatePromotionRequest;

use Illuminate\Http\Request;

class PromotionController extends BackendController
{   
    protected $promotionService; 

    public function __construct(PromotionService $promotionService) {
        $this->promotionService = $promotionService;
    }

    public function filter(Request $request) {
        $promotions = $this->promotionService->paginate($request);
        return $promotions;
    } 

    public function create(StorePromotionRequest $request) {
        $response = $this->promotionService->create($request);
        return $response;
    }
    public function update(UpdatePromotionRequest $request, $id) {
        $response = $this->promotionService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'promotion.destroy');
        $response = $this->promotionService->delete($id);
        return $response;
    }

    public function getPromotionConditionValue(Request $request) {
        $response = $this->promotionService->getPromotionConditionValue($request);
        return $response;
    }
}
