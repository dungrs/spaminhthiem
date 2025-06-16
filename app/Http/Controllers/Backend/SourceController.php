<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Services\SourceService;

class SourceController extends BackendController
{   
    protected $sourceService;

    public function __construct(
        SourceService $sourceService, 
    ) 
    {
        $this->sourceService = $sourceService;
    }

    public function index(Request $request) {
        $this->authorize('modules', 'source.index');
        $template = 'backend.source.index';
        $configs = $this->configs();
        $configs['seo'] = __('messages.source');
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
                'backend/js/pages/sources.js',
            ],
            'model' => 'Source',
            'modelParent' => ''
        ];
    }
}
