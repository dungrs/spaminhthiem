<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\PermissionService;

class PermissionController extends BackendController
{   
    protected $permissionService;

    public function __construct(
        PermissionService $permissionService, 
    ) 
    {
        $this->permissionService = $permissionService;
    }

    public function index(Request $request) {
        $template = 'backend.permission.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.permission');
        $configs['method'] = 'index';
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
        ));
    }

    public function configs() {
        return [
            'js' => [
                'backend/js/library.js',
                'backend/js/pages/permissions.js',
            ],
            'model' => 'Permission',
            'modelParent' => ''
        ];
    }
}
