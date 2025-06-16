<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\FrontendController;

use App\Repositories\SystemRepository;

use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends FrontendController
{   
    protected $cartService;

    public function __construct(
        SystemRepository $systemRepository,
        CartService $cartService
    ) {
        parent::__construct($systemRepository);
        $this->cartService = $cartService;
    }

    public function create(Request $request) {
        $response = $this->cartService->create($request, $this->language);
        return $response;
    }

    public function update(Request $request) {
        $response = $this->cartService->update($request);
        return $response;
    }

    public function delete(Request $request) {
        $response = $this->cartService->delete($request);
        return $response;
    }

    public function deleteAll() {
        $response = $this->cartService->deleteAll();
        return $response;
    }
}
