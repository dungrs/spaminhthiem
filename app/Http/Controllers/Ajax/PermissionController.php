<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;

use App\Services\PermissionService;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends BackendController
{   
    protected $permissionService; 

    public function __construct(PermissionService $permissionService) {
        $this->permissionService = $permissionService;
    }
    
    public function filter(Request $request) {
        $permissions = $this->permissionService->paginate($request);
        return $permissions;
    } 

    public function create(StorePermissionRequest $request) {
        $this->authorize('modules', 'permission.create');
        $response = $this->permissionService->create($request);
        return $response;
    }

    public function edit($id) {
        $permission = $this->permissionService->getPermissionDetails($id);
        return $permission;
    }

    public function update(UpdatePermissionRequest $request, $id) {
        $this->authorize('modules', 'permission.update');
        $response = $this->permissionService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'permission.destroy');
        $response = $this->permissionService->delete($id);
        return $response;
    }
}
