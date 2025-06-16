<?php

namespace App\Http\Controllers\Ajax\Product;

use App\Http\Controllers\BackendController;
use App\Services\Product\ProductService;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

use Illuminate\Http\Request;

class ProductController extends BackendController
{   
    protected $productService; 

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function filter(Request $request) {
        $products = $this->productService->paginate($request);
        return $products;
    } 

    public function create(StoreProductRequest $request) {
        $response = $this->productService->create($request);
        return $response;
    }
    public function update(UpdateProductRequest $request, $id, $languageId) {
        $response = $this->productService->update($request, $id, $languageId);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'post.destroy');
        $response = $this->productService->delete($id);
        return $response;
    }

    public function loadProductAnimation(Request $request) {
        $response = $this->productService->loadProductAnimation($request);
        return $response;
    }

    // FRONTEND CONTROLLER
    public function loadVariant(Request $request) {
        $response = $this->productService->loadVariant($request);
        return $response;
    }

    public function loadProduct(Request $request) {
        $languageId = $request->input('language_id');
        $productId = $request->input('product_id');
        $response = $this->productService->prepareFrontendProductData($productId, $languageId, true);
        return $response;
    }

    public function filterUser(Request $request) {
        $products = $this->productService->paginateUser($request);
        return $products;
    }
}
