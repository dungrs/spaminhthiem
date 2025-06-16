<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;

use App\Services\SourceService;

use App\Http\Requests\Source\StoreSourceRequest;
use App\Http\Requests\Source\UpdateSourceRequest;
use Illuminate\Http\Request;

class SourceController extends BackendController
{   
    protected $sourceService; 

    public function __construct(SourceService $sourceService) {
        $this->sourceService = $sourceService;
    }
    
    public function filter(Request $request) {
        $sources = $this->sourceService->paginate($request);
        return $sources;
    } 

    public function create(StoreSourceRequest $request) {
        $this->authorize('modules', 'source.create');
        $response = $this->sourceService->create($request);
        return $response;
    }

    public function edit($id) {
        $source = $this->sourceService->getSourceDetails($id);
        return $source;
    }

    public function update(UpdateSourceRequest $request, $id) {
        $this->authorize('modules', 'source.update');
        $response = $this->sourceService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'source.destroy');
        $response = $this->sourceService->delete($id);
        return $response;
    }

    public function getAllSource() {
        $response = $this->sourceService->getAll();
        return $response;
    }
}
