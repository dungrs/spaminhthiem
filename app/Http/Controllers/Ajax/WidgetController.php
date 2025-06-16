<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;
use App\Services\WidgetService;

use App\Http\Requests\Widget\StoreWidgetRequest;
use App\Http\Requests\Widget\UpdateWidgetRequest;

use Illuminate\Http\Request;

class WidgetController extends BackendController
{   
    protected $widgetService; 

    public function __construct(WidgetService $widgetService) {
        $this->widgetService = $widgetService;
    }

    public function filter(Request $request) {
        $widgets = $this->widgetService->paginate($request);
        return $widgets;
    } 

    public function create(StoreWidgetRequest $request) {
        $response = $this->widgetService->create($request);
        return $response;
    }
    public function update(UpdateWidgetRequest $request, $id, $languageId) {
        $response = $this->widgetService->update($request, $id, $languageId);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'widget.destroy');
        $response = $this->widgetService->delete($id);
        return $response;
    }

    public function findModelObject(Request $request) {
        $response = $this->widgetService->findModelObject($request);
        return $response;
    }

    public function saveTranslate(Request $request) {
        $option = $request->input('option');
        $response = $this->widgetService->saveTranslate($option, $request);
        return $response;
    }
}
