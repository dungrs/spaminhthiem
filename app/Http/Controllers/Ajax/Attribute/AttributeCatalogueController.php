<?php

namespace App\Http\Controllers\Ajax\Attribute;

use App\Http\Controllers\BackendController;
use App\Services\Attribute\AttributeCatalogueService;

use App\Http\Requests\Attribute\StoreAttributeCatalogueRequest;
use App\Http\Requests\Attribute\UpdateAttributeCatalogueRequest;
use App\Http\Requests\Attribute\DeleteAttributeCatalogueRequest;

use Illuminate\Http\Request;

class AttributeCatalogueController extends BackendController
{   
    protected $attributeCatalogueService; 

    public function __construct(AttributeCatalogueService $attributeCatalogueService) {
        $this->attributeCatalogueService = $attributeCatalogueService;
    }

    public function filter(Request $request) {
        $attributeCatalogues = $this->attributeCatalogueService->paginate($request);
        return $attributeCatalogues;
    } 

    public function create(StoreAttributeCatalogueRequest $request) {
        $response = $this->attributeCatalogueService->create($request);
        return $response;
    }
    public function update(UpdateAttributeCatalogueRequest $request, $id, $languageId) {
        $response = $this->attributeCatalogueService->update($request, $id, $languageId);
        return $response;
    }

    public function delete(DeleteAttributeCatalogueRequest $request, $id) {
        $this->authorize('modules', 'attribute.catalogue.destroy');
        $response = $this->attributeCatalogueService->delete($id);
        return $response;
    }
}
