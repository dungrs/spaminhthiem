<?php

namespace App\Http\Controllers\Ajax\Attribute;

use App\Http\Controllers\BackendController;
use App\Services\Attribute\AttributeService;

use App\Http\Requests\Attribute\StoreAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;

use Illuminate\Http\Request;

class AttributeController extends BackendController
{   
    protected $attributeService; 

    public function __construct(AttributeService $attributeService) {
        $this->attributeService = $attributeService;
    }

    public function filter(Request $request) {
        $attributes = $this->attributeService->paginate($request);
        return $attributes;
    } 

    public function create(StoreAttributeRequest $request) {
        $response = $this->attributeService->create($request);
        return $response;
    }

    public function update(UpdateAttributeRequest $request, $id, $languageId) {
        $response = $this->attributeService->update($request, $id, $languageId);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'attribute.destroy');
        $response = $this->attributeService->delete($id);
        return $response;
    }

    public function getAttribute(Request $request) {
        $response = $this->attributeService->getAttributeAjax($request);
        return $response;
    }

    public function loadAttribute(Request $request, $languageId) {
        $response = $this->attributeService->loadAttributeAjax($request, $languageId);
        return $response;
    }
}
