<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\SystemService;

use App\Classes\System;

class SystemController extends BackendController
{   
    protected $systemService;
    protected $systemLibrary;

    public function __construct(
        SystemService $systemService, 
        System $systemLibrary,
    ) 
    {
        $this->systemService = $systemService;
        $this->systemLibrary = $systemLibrary;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'system.index');
        $template = 'backend.system.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.system');
        $configs['method'] = 'index';
        $systemConfigs = $this->systemLibrary->config();
        $systems = $this->systemService->getSystemDetails();
        return view('backend.dashboard.layout', compact(
            'template',
            'configs',
            'systemConfigs',
            'systems'
        ));
    }

    public function configs() {
        return [
            'js' => [
                'backend/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js',
                'backend/libs/ckfinder/ckfinder.js',
                'backend/js/ckfinder.js',
                'backend/js/ckeditor.js',
                'backend/js/library.js',
                'backend/js/pages/systems.js',
            ],
            'model' => 'System',
            'modelParent' => ''
        ];
    }
}
