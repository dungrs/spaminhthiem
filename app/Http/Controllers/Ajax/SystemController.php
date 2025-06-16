<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;

use App\Services\SystemService;

use Illuminate\Http\Request;

class SystemController extends BackendController
{   
    protected $systemService; 

    public function __construct(SystemService $systemService) {
        $this->systemService = $systemService;
    }

    public function create(Request $request) {
        $this->authorize('modules', 'system.create');
        $response = $this->systemService->create($request);
        return $response;
    }
}
