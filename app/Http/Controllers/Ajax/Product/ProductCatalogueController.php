<?php

namespace App\Http\Controllers\Ajax\Product;

use App\Http\Controllers\BackendController;
use App\Services\Product\ProductCatalogueService;

use App\Http\Requests\Product\StoreProductCatalogueRequest;
use App\Http\Requests\Product\UpdateProductCatalogueRequest;
use App\Http\Requests\Product\DeleteProductCatalogueRequest;

use Illuminate\Http\Request;

class ProductCatalogueController extends BackendController
{   
    protected $productCatalogueService; 

    public function __construct(ProductCatalogueService $productCatalogueService) {
        $this->productCatalogueService = $productCatalogueService;
    }

    public function filter(Request $request) {
        $productCatalogues = $this->productCatalogueService->paginate($request);
        return $productCatalogues;
    } 

    public function create(StoreProductCatalogueRequest $request) {
        $response = $this->productCatalogueService->create($request);
        return $response;
    }
    public function update(UpdateProductCatalogueRequest $request, $id, $languageId) {
        $response = $this->productCatalogueService->update($request, $id, $languageId);
        return $response;
    }

    public function delete(DeleteProductCatalogueRequest $request, $id) {
        $this->authorize('modules', 'product.catalogue.destroy');
        $response = $this->productCatalogueService->delete($id);
        return $response;
    }
}
